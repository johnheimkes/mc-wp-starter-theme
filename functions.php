<?php
/**
 * Functions and definitions
 *
 * @package JBH
 */

use JBH\App\Core\Init;
use JBH\App\Setup;
use JBH\App\Scripts;
use JBH\App\Media;
use JBH\App\Shortcodes;
use JBH\App\Fields\ACF;
use JBH\App\Fields\Options;
use JBH\App\Fields\Modules;
use JBH\App\Fields\FieldGroups\SiteOptionsFieldGroup;
use JBH\App\Fields\FieldGroups\PageBuilderFieldGroup;
use JBH\App\Blocks\RegisterBlocks;

/**
 * Define Theme Version
 * Define Theme directories
 */
define('THEME_VERSION', '2.5.0');
define('JBH_THEME_DIR', trailingslashit(get_template_directory()));
define('JBH_THEME_PATH_URL', trailingslashit(get_template_directory_uri()));

// Require Autoloader
require_once JBH_THEME_DIR . 'vendor/autoload.php';

/**
 * Theme Setup
 */
add_action('after_setup_theme', function () {

    (new Init())
        ->add(new Setup())
        ->add(new Scripts())
        ->add(new Media())
        ->add(new Shortcodes())
        ->add(new ACF())
        ->add(new Options())
        ->add(new Modules())
        ->add(new SiteOptionsFieldGroup())
        ->add(new PageBuilderFieldGroup())
        ->add(new RegisterBlocks())
        ->initialize();

    // Translation setup
    load_theme_textdomain('jbh-starter', JBH_THEME_DIR . '/languages');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Add automatic feed links in header
    add_theme_support('automatic-feed-links');

    // Add Post Thumbnail Image sizes and support
    add_theme_support('post-thumbnails');

    // Switch default core markup to output valid HTML5.
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ]);
});
