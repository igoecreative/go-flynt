<?php

/**
 * Defines default config for Nononesense plugin.
 */

namespace Flynt\NononesenseConfig;

// Removes Settings
add_filter('r34nono_define_settings_array', function($settings) {
    $hide_toggle = $_ENV['HIDE_CRITICAL_SETTINGS'];

    // Flynt Already removes Emojis
    unset($settings['r34nono_remove_wp_emoji']);
    // Flynt disables FSE
    unset($settings['r34nono_disallow_full_site_editing']);
    // Unneeded
    unset($settings['r34nono_prevent_block_directory_access']);
    // Handled by Flynt
    unset($settings['r34nono_remove_edit_site']);
    // Handled by Flynt
    unset($settings['r34nono_remove_global_styles']);
    // No widgets
    unset($settings['r34nono_remove_widgets_block_editor']);

    if ($hide_toggle == true) {
        $settings = hideR34Settings($settings);
    }

	return $settings;
});

function hideR34Settings($settings) {
    $settings['r34nono_admin_bar_logout_link']['show_in_admin'] = false;
    $settings['r34nono_hide_admin_bar_for_logged_in_non_editors']['show_in_admin'] = false;
    $settings['r34nono_disable_site_search']['show_in_admin'] = false;
    $settings['r34nono_disallow_file_edit']['show_in_admin'] = false;
    $settings['r34nono_limit_admin_elements_for_logged_in_non_editors']['show_in_admin'] = false;
    $settings['r34nono_login_replace_wp_logo_link']['show_in_admin'] = false;
    $settings['r34nono_redirect_admin_to_homepage_for_logged_in_non_editors']['show_in_admin'] = false;
    $settings['r34nono_remove_admin_color_scheme_picker']['show_in_admin'] = false;
    $settings['r34nono_remove_admin_wp_logo']['show_in_admin'] = false;
    $settings['r34nono_remove_comments_from_admin']['show_in_admin'] = false;
    $settings['r34nono_remove_comments_from_front_end']['show_in_admin'] = false;
    $settings['r34nono_remove_dashboard_widgets']['show_in_admin'] = false;
    $settings['r34nono_remove_default_block_patterns']['show_in_admin'] = false;
    $settings['r34nono_remove_duotone_svg_filters']['show_in_admin'] = false;
    $settings['r34nono_remove_front_end_edit_links']['show_in_admin'] = false;
    $settings['r34nono_remove_howdy']['show_in_admin'] = false;
    $settings['r34nono_remove_posts_from_admin']['show_in_admin'] = false;
    $settings['r34nono_xmlrpc_disabled']['show_in_admin'] = false;

	return $settings;
};

