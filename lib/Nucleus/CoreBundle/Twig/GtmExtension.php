<?php

namespace Nucleus\CoreBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class GtmExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('merge_gtm_data', "\Nucleus\CoreBundle\Twig\GtmExtension::mergeGtmData"),
        ];
    }

    public static function mergeGtmData($data, $gtmData)
    {
        $htmlAttributes = [];

        foreach ($gtmData as $property => $value) {
            $htmlAttributes['data-gtm-' . $property] = $value;
        }

        return CoreExtension::mergeData($data, [
            'htmlAttributes' => $htmlAttributes,
        ]);
    }
}
