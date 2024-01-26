<?php

/*
 * Add WooCommerce support to our theme
 */
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

/*
 * https://timber.github.io/docs/v2/guides/woocommerce/
 * necessary for WooCommerce to get the proper contect in Timber I think
 */
function timber_set_product($post)
{
    global $product;

    if (is_woocommerce()) {
        $product = wc_get_product($post->ID);
    }
}

/*
 * Remove default related products from the theme
 */
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/*
 * Set our own content wrapper
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
    echo '<flynt-component name="BlockWysiwyg" class="componentSpacing">';
    echo '<div class="container">';
    echo '<div class="content" data-size="full" data-align="left" data-text-align="left">';
}

function my_theme_wrapper_end() {
    echo '<div><!-- Content -->';
    echo '</div><!-- Container -->';
    echo '</flynt-component>';
}


