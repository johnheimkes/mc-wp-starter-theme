<?php

namespace JBH\App\Fields\FieldGroups;

use JBH\App\Interfaces\WordPressHooks;

/**
 * Class RegisterFieldGroups
 *
 * @package JBH\App\Fields
 */
abstract class RegisterFieldGroups implements WordPressHooks
{

    /**
     * Add class hooks.
     */
    public function addHooks()
    {
        add_action('admin_init', [$this, 'registerFieldGroup']);
    }

    /**
     * Register Field Group via WordPlate
     */
    abstract public function registerFieldGroup();

    /**
     * Register the fields that will be available to this Field Group.
     *
     * @return array
     */
    abstract public function getFields();
}
