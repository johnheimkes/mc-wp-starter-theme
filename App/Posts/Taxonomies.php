<?php

namespace JBH\App\Posts;

/**
 * Class Taxonomies
 *
 * @package JBH\App\Posts
 */
class Taxonomies
{

    /**
     * Taxonomies constructor.
     *
     * Example Usage:
     *
     * Taxonomies::registerTaxonomy(
     * 'location',
     * __( 'Location', 'jbh-starter' ),
     * __( 'Locations', 'jbh-starter' ),
     * [ 'project' ]
     * );
     *
     * @param $slug
     * @param $singular
     * @param $plural
     * @param array $types Object type or array of object types
     * @param array $args
     */
    public static function registerTaxonomy($slug, $singular, $plural, $types = [], $args = [])
    {
        $labels = [
            'name'              => $plural,
            'singular_name'     => $singular,
            'menu_name'         => $plural,
            'search_items'      => sprintf(__('Search %1$s', 'jbh-starter'), $plural),
            'all_items'         => sprintf(__('All %1$s', 'jbh-starter'), $plural),
            'parent_item'       => sprintf(__('Parent %1$s', 'jbh-starter'), $singular),
            'parent_item_colon' => sprintf(__('Parent %1$s:', 'jbh-starter'), $singular),
            'edit_item'         => sprintf(__('Edit %1$s', 'jbh-starter'), $singular),
            'update_item'       => sprintf(__('Update %1$s', 'jbh-starter'), $singular),
            'add_new_item'      => sprintf(__('Add New %1$s', 'jbh-starter'), $singular),
            'new_item_name'     => sprintf(__('New %1$s Name', 'jbh-starter'), $singular)
        ];

        $defaults = [
            'labels'            => $labels,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true
        ];

        register_taxonomy($slug, $types, wp_parse_args($args, $defaults));
    }
}
