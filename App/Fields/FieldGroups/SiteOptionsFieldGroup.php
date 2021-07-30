<?php

namespace JBH\App\Fields\FieldGroups;

use WordPlate\Acf\Location;
use JBH\App\Fields\Options\Branding;

/**
 * Class SiteOptionsFieldGroup
 *
 * @package JBH\App\Fields\SiteOptionsFieldGroup
 */
class SiteOptionsFieldGroup extends RegisterFieldGroups
{
    /**
     * Register Field Group via Wordplate
     */
    public function registerFieldGroup()
    {
        register_extended_field_group([
            'title'    => __('Site Options', 'jbh-starter'),
            'fields'   => $this->getFields(),
            'location' => [
                Location::if('options_page', 'theme-general-options')
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
        return apply_filters(
            'jbh/field-group/site-options/fields',
            array_merge(
                (new Branding())->fields()
            )
        );
    }
}
