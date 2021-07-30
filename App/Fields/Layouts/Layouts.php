<?php

namespace JBH\App\Fields\Layouts;

use JBH\App\Fields\ACF;
use WordPlate\Acf\Fields\Tab;

/**
 * Class Layouts
 *
 * @package JBH\App\Fields\Layouts
 */
abstract class Layouts
{
    /**
     * Defines fields for layout.
     *
     * @return object
     */
    abstract public function fields();

    /**
     * Creates Content Tab Field.
     *
     * @return object
     */
    public function contentTab()
    {
        return Tab::make(__('Content', 'jbh-starter'), 'content-tab')
            ->placement('left');
    }

    /**
     * Creates Options Tab Field.
     *
     * @return object
     */
    public function optionsTab()
    {
        return Tab::make(__('Options', 'jbh-starter'), 'options-tab')
            ->placement('left');
    }
}
