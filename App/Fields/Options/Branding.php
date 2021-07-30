<?php

namespace JBH\App\Fields\Options;

use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Image;

/**
 * Class Branding
 *
 * @package JBH\App\Fields\Options
 */
class Branding
{
    /**
     * Defines fields used within Options tab.
     *
     * @return array
     */
    public function fields()
    {
        return apply_filters(
            'jbh/options/branding',
            [
                Tab::make('Branding')
                    ->placement('left'),
                Image::make('Site Logo')
                    ->returnFormat('array')
                    ->previewSize('thumbnail')
            ]
        );
    }
}
