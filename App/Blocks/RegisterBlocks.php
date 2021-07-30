<?php

namespace JBH\App\Blocks;

use JBH\App\Interfaces\WordPressHooks;

/**
 * Class RegisterBlocks
 *
 * @package JBH\App\Blocks
 */
class RegisterBlocks implements WordPressHooks
{
    public $block_key = 'jbh-blocks';

    /**
     * Add class hooks.
     */
    public function addHooks()
    {
        add_action('init', [$this, 'registerBlocks']);
        add_filter('block_categories', [$this, 'registerBlockCategory'], 10, 2);
    }

    /**
     * Register custom JBH blocks
     */
    public function registerBlocks()
    {
        // automatically load dependencies and version
        $dir_path   = JBH_THEME_PATH_URL . 'blocks/';
        $asset_file = include JBH_THEME_DIR . 'blocks/build/index.asset.php';

        wp_register_script(
            $this->block_key,
            $dir_path . 'build/index.js',
            $asset_file['dependencies'],
            $asset_file['version']
        );

        wp_register_style(
            $this->block_key,
            get_stylesheet_directory_uri() . '/build/css/editor.min.css',
            ['wp-edit-blocks']
        );

        register_block_type(
            'jbh-blocks/blocks',
            [
                'editor_script' => $this->block_key,
                'editor_style'  => $this->block_key
            ]
        );
    }

    /**
     * Register custom JBH blocks category
     *
     * @param array $categories
     * @param object $post
     */
    public function registerBlockCategory($categories, $post)
    {
        return array_merge(
            $categories,
            [
                [
                    'slug'  => 'jbh_blocks',
                    'title' => __('JBH Blocks', 'mc-starter'),
                ],
            ]
        );
    }
}
