<?php

namespace JBH\App\Fields\Layouts;

use WordPlate\Acf\Fields\Layout;
use WordPlate\Acf\Fields\Wysiwyg;
use WordPlate\Acf\Fields\Textarea;

/**
 * Class ContentArea
 *
 * @package JBH\App\Fields\Layouts
 */
class ContentArea extends Layouts
{
    /**
     * Defines fields for this layout.
     *
     * @return object
     */
    public function fields()
    {
        return apply_filters(
            'jbh/layout/content-area',
            Layout::make(__('Content Area', 'jbh-starter'))
                ->layout('block')
                ->fields([
                    $this->contentTab(),
                    Textarea::make(__('Headline', 'jbh-starter'))
                        ->rows(2),
                    Wysiwyg::make(__('Content', 'jbh-starter'))
                        ->mediaUpload(false)
                ])
        );
    }
}
