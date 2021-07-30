<?php

namespace JBH\App;

use JBH\App\Interfaces\WordPressHooks;

/**
 * Class Setup
 *
 * @package JBH\App
 */
class Setup implements WordPressHooks
{

    /**
     * Add class hooks.
     */
    public function addHooks()
    {
        add_action('init', [$this, 'registerMenus']);
        add_action('widgets_init', [$this, 'registerSidebars'], 5);
    }

    /**
     * Registers nav menu locations.
     */
    public function registerMenus()
    {
        register_nav_menu('primary', __('Primary', 'jbh-starter'));
    }

    /**
     * Registers sidebars.
     */
    public function registerSidebars()
    {
        register_sidebar(
            [
                'id'            => 'primary',
                'name'          => __('Sidebar', 'jbh-starter'),
                'description'   => __('Main sidebar area displayed on right side of page via trigger.', 'jbh-starter'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
            ]
        );
    }
}
