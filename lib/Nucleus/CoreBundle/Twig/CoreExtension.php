<?php

namespace Nucleus\CoreBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CoreExtension extends AbstractExtension
{
    private static string $currentAssetNamespace = 'nucleus';

    public function getFilters()
    {
        return [
            new TwigFilter('get_modifier', '\Nucleus\CoreBundle\Twig\CoreExtension::getModifier'),
            new TwigFilter('merge_data', '\Nucleus\CoreBundle\Twig\CoreExtension::mergeData'),
            new TwigFilter('render_attributes', '\Nucleus\CoreBundle\Twig\CoreExtension::renderAttributes', ['is_safe' => ['html']]),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('render_attributes', '\Nucleus\CoreBundle\Twig\CoreExtension::renderAttributes', ['is_safe' => ['html']]),
            new TwigFunction('set_project', '\Nucleus\CoreBundle\Twig\CoreExtension::setProject'),
            new TwigFunction('get_asset_namespace', '\Nucleus\CoreBundle\Twig\CoreExtension::getAssetNamespace'),
        ];
    }

    /**
     * Returns the modifier for the markup of the component.
     *
     * @param {Boolean|Array|String} attributeValue
     * @param {String} modifierName
     * @param {Array} optionsArray
     * @param {String} optionsArray['property']
     * @param {Boolean} optionsArray['omitDefaultModifier']
     * @param {Boolean} optionsArray['additionalCondition']
     *
     * @return {String|Null|Array|*}
     */
    public static function getModifier($attributeValue, $modifierName, $optionsArray = null)
    {
        if (!isset($optionsArray['additionalCondition'])) {
            $optionsArray['additionalCondition'] = true;
        }

        if (!isset($optionsArray['omitDefaultModifier'])) {
            $optionsArray['omitDefaultModifier'] = false;
        }

        $defaultValue = '';

        if (isset($optionsArray['property']) && $optionsArray['omitDefaultModifier']) {
            $component = SchemaExtension::getCurrentComponentScope();
            $defaultValue = self::getDefaultValue($component, $optionsArray['property']);
        }

        if (isset($attributeValue) && $optionsArray['additionalCondition']) {
            if (\is_bool($attributeValue)) {
                if (true === $attributeValue) {
                    return $modifierName;
                }
            } elseif (\is_array($attributeValue)) {
                $modifierClasses = [];

                if (isset($attributeValue['xs'])) {
                    if ($defaultValue !== $attributeValue['xs']) {
                        array_push($modifierClasses, $modifierName . '-' . self::formatModifierValue($attributeValue['xs']));
                    }
                }

                if (isset($attributeValue['sm'])) {
                    array_push($modifierClasses, $modifierName . '-' . self::formatModifierValue($attributeValue['sm']) . '@sm');
                }

                if (isset($attributeValue['md'])) {
                    array_push($modifierClasses, $modifierName . '-' . self::formatModifierValue($attributeValue['md']) . '@md');
                }

                if (isset($attributeValue['lg'])) {
                    array_push($modifierClasses, $modifierName . '-' . self::formatModifierValue($attributeValue['lg']) . '@lg');
                }

                return $modifierClasses;
            } else {
                if ($defaultValue !== $attributeValue) {
                    return $modifierName . '-' . self::formatModifierValue($attributeValue);
                }
            }
        }

        return null;
    }

    public static function mergeData($data, $additionalData, $override = true)
    {
        self::mergeRecursive($data, $additionalData, $override);

        return $data;
    }

    /**
     * @param array $htmlAttributes
     * @param array $styleAttributes
     * @param array $extensions
     *
     * @return string
     */
    public static function renderAttributes($htmlAttributes, $styleAttributes = null, $extensions = null)
    {
        $results = '';
        $classList = [];
        $escapeMap = [
            "\n" => '&#xa;',
            "\t" => '&#x9;',
            "\r" => '&#xd;',
            '&' => '&amp;',
            '"' => '&quot;',
            '<' => '&lt;',
            '>' => '&gt;',
        ];

        if (isset($htmlAttributes['class'])) {
            $classList = explode(' ', $htmlAttributes['class']);
            unset($htmlAttributes['class']);
        }

        if (isset($htmlAttributes['classList'])) {
            $classList[] = $htmlAttributes['classList'];
            unset($htmlAttributes['classList']);
        }

        if ($styleAttributes) {
            self::prepareStyleAttributes($htmlAttributes, $styleAttributes);
        }

        if ($extensions) {
            self::prepareExtensions($htmlAttributes, $extensions);
        }

        foreach ($htmlAttributes as $key => $value) {
            if (self::startsWith($key, 'margin') || self::startsWith($key, 'padding')) {
                $modifier = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $key));
                $classList[] = self::getModifier($value, $modifier);
            } elseif (true === $value) {
                $results .= ' ' . $key;
            } elseif (!empty($value) || is_numeric($value) || \is_string($value)) {
                $value = str_replace(array_keys($escapeMap), array_values($escapeMap), $value);
                $results .= ' ' . $key . '="' . $value . '"';
            }
        }

        if (\count($classList)) {
            $classList = self::arrayFlatten($classList);
            $results = ' class="' . implode(' ', $classList) . '"' . $results;
        }

        return $results;
    }

    /**
     * Sets the current project.
     *
     * @param {String} $project
     */
    public static function setProject($project): void
    {
        if ('nucleus' != $project) {
            self::$currentAssetNamespace = 'nucleus_' . $project;
        } else {
            self::$currentAssetNamespace = $project;
        }
    }

    /**
     * Returns the asset namespace.
     *
     * @return {String}
     */
    public static function getAssetNamespace()
    {
        return self::$currentAssetNamespace;
    }

    /**
     * Returns the "default" Value from the nucleus manifest of the component.
     *
     * @param {String} component
     * @param {String} property
     *
     * @return {String}
     */
    private static function getDefaultValue($component, $property)
    {
        $manifest = SchemaExtension::getManifest();

        return $manifest['modules']['@' . $component]['schema']['properties'][$property]['default'];
    }

    private static function mergeRecursive(&$data, $additionalData, $override): void
    {
        if (\is_array($additionalData)) {
            foreach ($additionalData as $key => $value) {
                if (null !== $value) {
                    if (isset($data[$key])) {
                        if (\is_array($value) && \is_array($data[$key])) {
                            if (self::arrayHasStringKeys($value)) {
                                self::mergeRecursive($data[$key], $value, $override);
                            } else {
                                $data[$key] = array_merge($data[$key], $value);
                            }
                        } elseif ('class' === $key && \is_string($value)) {
                            $data[$key] = trim($data[$key]) . ' ' . trim($value);
                        } elseif ($override) {
                            $data[$key] = $value;
                        }
                    } else {
                        $data[$key] = $value;
                    }
                }
            }
        }
    }

    private static function arrayHasStringKeys(array $array)
    {
        return \count(array_filter(array_keys($array), 'is_string')) > 0;
    }

    private static function arrayFlatten($array, $return = [])
    {
        for ($x = 0; $x < \count($array); ++$x) {
            if (\is_array($array[$x])) {
                $return = self::arrayFlatten($array[$x], $return);
            } else {
                if (isset($array[$x])) {
                    $return[] = $array[$x];
                }
            }
        }

        return $return;
    }

    private static function startsWith($string, $startString)
    {
        $len = \strlen($startString);

        return substr($string, 0, $len) === $startString;
    }

    private static function formatModifierValue($value)
    {
        if (\is_int($value)) {
            if ($value < 0) {
                return 'negative-' . abs($value);
            }
        }

        return $value;
    }

    private static function prepareStyleAttributes(&$htmlAttributes, $styleAttributes): void
    {
        if (isset($styleAttributes['xs']) ||
            isset($styleAttributes['sm']) ||
            isset($styleAttributes['md']) ||
            isset($styleAttributes['lg'])) {
            $attributesPerBreakpoint = $styleAttributes;
        } else {
            $attributesPerBreakpoint = [
                'xs' => $styleAttributes,
            ];
        }

        foreach ($attributesPerBreakpoint as $breakpoint => $breakpointStyleAttributes) {
            $styleAttribute = implode(
                '',
                array_map(function ($propertyName, $propertyValue) {
                    return $propertyName . ':' . $propertyValue . ';';
                }, array_keys($breakpointStyleAttributes), $breakpointStyleAttributes)
            );

            if ('xs' === $breakpoint) {
                if (isset($htmlAttributes¢['style'])) {
                    $styleAttribute = $htmlAttributes¢['style'] . $styleAttribute;
                }

                $htmlAttributes['style'] = $styleAttribute;
            } else {
                $htmlAttributes['data-style-' . $breakpoint] = $styleAttribute;
            }
        }
    }

    private static function prepareExtensions(&$htmlAttributes, $extensions): void
    {
        foreach ($extensions as $extension) {
            $attributeName = 'data-' . str_replace('/', '-', $extension['module']);
            $htmlAttributes[$attributeName] = json_encode($extension);
        }
    }
}
