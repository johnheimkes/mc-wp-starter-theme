<?php
/**
 * Template Name: Page Builder
 *
 * This template displays Advanced Custom Fields
 * flexible content fields in a user-defined order.
 *
 * @package JBH
 */

get_header();

// hook: App/Fields/Modules/outputFlexibleModules()
do_action('jbh/modules/output', get_the_ID());

get_footer();
