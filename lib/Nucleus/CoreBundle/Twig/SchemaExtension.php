<?php

namespace Nucleus\CoreBundle\Twig;

use Exception;
use Symfony\Component\Yaml\Yaml;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFilter;
use Twig\TwigFunction;

class SchemaExtension extends AbstractExtension implements GlobalsInterface
{
    private static array $data = [];
    private static string $currentComponentScope = '';

    public function __construct(string $projectDir)
    {
        $loader = new FilesystemLoader([], $projectDir);
        $loader->addPath($projectDir . '/lib/Nucleus/ComponentBundle/Resources/data', 'nucleus-data');

        $environment = new Environment($loader);
        self::$data = self::buildNucleusData($environment);
    }

    /**
     * Returns the current component.
     */
    public static function getCurrentComponentScope(): string
    {
        return self::$currentComponentScope;
    }

    /**
     * Returns manifest of the current component.
     */
    public static function getManifest(): array
    {
        return self::$data;
    }

    public function getGlobals(): array
    {
        return [
            'nucleus' => self::$data,
        ];
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('validate_data', '\Nucleus\CoreBundle\Twig\SchemaExtension::validateData'),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_data', '\Nucleus\CoreBundle\Twig\SchemaExtension::getData', ['needs_environment' => true]),
        ];
    }

    public static function buildNucleusData(Environment $env)
    {
        $fullPath = self::resolveTwigPath($env, '@nucleus-data/manifest.nucleus.json');
        $fileString = file_get_contents($fullPath);

        return json_decode($fileString, true);
    }

    public static function validateData($data, $component, $throwExceptionOnError = true, $deepValidate = false)
    {
        $data['_validation'] = [
            'hasErrors' => false,
            'hasWarnings' => false,
            'errors' => [],
            'warnings' => [],
        ];

        if (isset($data['component'])) {
            $moduleName = $data['component'];
        } elseif (isset($data['module'])) {
            $moduleName = $data['module'];
        } else {
            self::setValidationError($data, 'Invalid object for module. Either component or module must be set.', 'module', $throwExceptionOnError);

            return $data;
        }

        if (!$component) {
            $component = $moduleName;
        } elseif ($component != $moduleName) {
            self::setValidationError($data, "The component ID provided for '" . $component . "' does not match: '" . $moduleName . "'.", 'module', $throwExceptionOnError);

            return $data;
        }

        $schema = self::$data['modules']['@' . $component]['schema'];

        foreach ($schema['properties'] as $propertyName => $propertyOptions) {
            if (!isset($data[$propertyName])) {
                if (\in_array($propertyName, $schema['required'])) {
                    self::setValidationError($data, "The required property '" . $propertyName . "' is missing in the data of '" . $component . "'.", $propertyName, $throwExceptionOnError);
                } elseif (isset($propertyOptions['default'])) {
                    $data[$propertyName] = $propertyOptions['default'];
                } else {
                    $data[$propertyName] = null;
                }
            } else {
                if (isset($propertyOptions['deprecated'])) {
                    self::setValidationWarning($data, "Deprecated property '" . $propertyName . "' is used in the data of '" . $component . "'.", $propertyName, $data[$propertyName]);
                }

                if ('string' === $propertyOptions['type'] && isset($propertyOptions['enum'])) {
                    if (\is_array($data[$propertyName]) && isset($propertyOptions['isResponsive']) && $propertyOptions['isResponsive']) {
                        foreach ($data[$propertyName] as $viewport => $propertyValue) {
                            if (!\in_array($propertyValue, $propertyOptions['enum'])) {
                                if (isset($propertyOptions['default'])) {
                                    $data[$propertyName][$viewport] = $propertyOptions['default'];
                                } else {
                                    $data[$propertyName] = null;
                                }
                            }
                        }
                    } elseif (!\in_array($data[$propertyName], $propertyOptions['enum'])) {
                        self::setValidationWarning($data, "Invalid value for property '" . $propertyName . "' in the data of '" . $component . "'.", $propertyName, $data[$propertyName]);

                        if (isset($propertyOptions['default'])) {
                            $data[$propertyName] = $propertyOptions['default'];
                        } else {
                            $data[$propertyName] = null;
                        }
                    }
                } elseif ($deepValidate && 'object' === $propertyOptions['type'] && 0 === strpos($propertyName, 'object')) {
                    $data[$propertyName] = self::validateData($data[$propertyName], null, $throwExceptionOnError, true);
                    self::hoistChildValidationResult($data, $data[$propertyName], $propertyName);
                    unset($data[$propertyName]['_validation']);
                }
            }
        }

        $unknownProperties = array_diff(array_keys($data), array_keys($schema['properties']), ['_validation']);

        foreach ($unknownProperties as $unknownProperty) {
            self::setValidationWarning($data, "Unknown property '" . $unknownProperty . "' in the data of '" . $component . "'.", $unknownProperty, $data[$unknownProperty]);
        }

        if (isset($data['extensions'])) {
            foreach ($data['extensions'] as $index => $extension) {
                $data['extensions'][$index] = self::validateData($extension, null, $throwExceptionOnError, true);
                self::hoistChildValidationResult($data, $data['extensions'][$index], 'extensions[' . $index . ']');
                unset($data['extensions'][$index]['_validation']);
            }
        }

        self::setCurrentComponentScope($moduleName);

        return $data;
    }

    public static function getData(Environment $env, $path)
    {
        $full_path = is_file($path) ? $path : self::resolveTwigPath($env, $path);

        return self::loadFile($full_path);
    }

    /**
     * Sets the current component.
     */
    private static function setCurrentComponentScope($component): void
    {
        self::$currentComponentScope = $component;
    }

    private static function setValidationError(&$data, $message, $property, $throwExceptionOnError): void
    {
        if ($throwExceptionOnError) {
            throw new Exception($message);
        }

        $data['_validation']['hasErrors'] = true;
        $data['_validation']['errors'][] = [
            'message' => $message,
            'propertyPath' => [
                $property,
            ],
        ];
    }

    private static function setValidationWarning(&$data, $message, $property, $value = null): void
    {
        $data['_validation']['hasWarnings'] = true;
        $data['_validation']['warnings'][] = [
            'message' => $message,
            'propertyPath' => [
                $property,
            ],
            'value' => $value,
        ];
    }

    private static function hoistChildValidationResult(&$data, $childData, $path): void
    {
        if ($childData['_validation']['hasErrors']) {
            $data['_validation']['hasErrors'] = true;

            foreach ($childData['_validation']['errors'] as $error) {
                array_unshift($error['propertyPath'], $path);
                $data['_validation']['errors'][] = $error;
            }
        }

        if ($childData['_validation']['hasWarnings']) {
            $data['_validation']['hasWarnings'] = true;

            foreach ($childData['_validation']['warnings'] as $warning) {
                array_unshift($warning['propertyPath'], $path);
                $data['_validation']['warnings'][] = $warning;
            }
        }
    }

    private static function resolveTwigPath(Environment $env, $templateName)
    {
        $template = $env->resolveTemplate($templateName);
        $source = $template->getSourceContext();
        $full_path = $source->getPath();

        if (!file_exists($full_path)) {
            throw new \Exception('Resolved Twig File does not exist, given `' . $templateName . '`, found path `' . $full_path . '`.');
        }

        return $full_path;
    }

    private static function loadFile($full_path)
    {
        $file_data = [];

        if ('' !== $full_path && file_exists($full_path)) {
            $file_string = file_get_contents($full_path);
            $file_type = pathinfo($full_path)['extension'];

            switch ($file_type) {
                case 'json':
                    $file_data = json_decode($file_string, true);

                    break;
                case 'yaml' || 'yml':
                    $file_data = Yaml::parse($file_string);

                    break;
            }
        } else {
            throw new \Exception('Cannot find file when trying to run get_file_data: ' . $full_path);
        }

        return $file_data;
    }
}
