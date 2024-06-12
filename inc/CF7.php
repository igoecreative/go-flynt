<?php

/**
 * - Stop default CF7 files from loading if the CF7 plugin is installed
 */

namespace Flynt\CF7;

/*
 * - Stop default CF7 files from loading if the CF7 plugin is installed
 */

if ( class_exists( 'WPCF7_ContactForm' ) ) {
    add_filter( 'wpcf7_load_js', '__return_false' );
    add_filter( 'wpcf7_load_css', '__return_false' );
}

