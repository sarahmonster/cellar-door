<?php
/**
 * Load and customize plugins
 *
 * @package Feminist_Frequency
 */

// Allows us to assign multiple authors to a single post.
wpcom_vip_load_plugin( 'co-authors-plus' );

// For better term management.
wpcom_vip_load_plugin( 'term-management-tools' );

// For more precise excerpts.
wpcom_vip_load_plugin( 'advanced-excerpt' );

// For custom shortcodes.
wpcom_vip_load_plugin( 'shortcode-ui' );
