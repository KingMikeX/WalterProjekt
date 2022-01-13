<?php

namespace Nucleus\CoreBundle\Twig;

use Exception;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DebugExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('get_stack_trace', '\Nucleus\CoreBundle\Twig\DebugExtension::getStackTrace', ['is_safe' => ['html']]),
            new TwigFunction('throw_exception', '\Nucleus\CoreBundle\Twig\DebugExtension::throwException'),
        ];
    }

    public static function getStackTrace()
    {
        $stackTrace = [];

        foreach (debug_backtrace() as $trace) {
            $stackTraceEntry = [
                'file' => $trace['file'],
                'line' => $trace['line'],
                'function' => $trace['function'],
            ];

            if (\array_key_exists('class', $trace)) {
                $stackTraceEntry['class'] = $trace['class'];
            }

            if (isset($trace['object']) && (false !== strpos($trace['class'], '__TwigTemplate'))) {
                $stackTraceEntry['templateName'] = $trace['object']->getTemplateName();
            }

            $stackTrace[] = $stackTraceEntry;
        }

        return $stackTrace;
    }

    public static function throwException($message): void
    {
        throw new Exception($message . ' ' . 'Template: \'' . self::getTwigTemplateName() . '\'!');
    }

    private static function getTwigTemplateName()
    {
        foreach (debug_backtrace() as $trace) {
            if (isset($trace['object'])
                && (false !== strpos($trace['class'], 'TwigTemplate'))
                && 'Twig_Template' !== \get_class($trace['object'])
            ) {
                return $trace['object']->getTemplateName() . "({$trace['line']})";
            }
        }

        return '';
    }
}
