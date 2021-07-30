<?php

namespace JBH\App\Fields\FieldGroups;

use JBH\App\Fields\Layouts\Hero;
use JBH\App\Fields\Layouts\Image;
use JBH\App\Fields\Layouts\ContentArea;
use JBH\App\Fields\FieldGroups\RegisterFieldGroups;

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\FlexibleContent;

/**
 * Class PageBuilderFieldGroup
 *
 * @package JBH\App\Fields\PageBuilderFieldGroup
 */
class PageBuilderFieldGroup extends RegisterFieldGroups
{
    /**
     * Register Field Group via Wordplate
     */
    public function registerFieldGroup()
    {
        register_extended_field_group([
            'title'    => __('Page Builder', 'jbh-starter'),
            'fields'   => $this->getFields(),
            'location' => [
                Location::if('page_template', 'templates/page-builder.php')
            ],
            'style' => 'default'
        ]);
    }

    /**
     * Register the fields that will be available to this Field Group.
     *
     * @return array
     */
    public function getFields()
    {
        return apply_filters('jbh/field-group/page-builder/fields', [
            FlexibleContent::make(__('Modules', 'jbh-starter'))
                ->buttonLabel(__('Add Module', 'jbh-starter'))
                ->layouts([
                    (new ContentArea())->fields(),
                    (new Hero())->fields(),
                    (new Image())->fields(),
                ])
        ]);
    }
}
