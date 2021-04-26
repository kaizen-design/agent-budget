<?php

if (! class_exists('acf')) {
    add_filter('acf/settings/path', 'my_acf_settings_path');
    add_filter('acf/settings/dir', 'my_acf_settings_dir');
    include_once(__DIR__ . '/../core/acf/acf.php');
}

function my_acf_settings_path($path)
{
    $path = get_stylesheet_directory() . '/core/acf/';
    return $path;
}

function my_acf_settings_dir($dir)
{
    $dir = get_stylesheet_directory_uri() . '/core/acf/';
    return $dir;
}

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Theme Options',
        'menu_title'    => 'Theme Options',
        'menu_slug'     => 'theme-options-settings',
        'capability'    => 'edit_posts',
        'redirect'      => true
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'General Settings',
        'menu_title'    => 'General Settings',
        'parent_slug'   => 'theme-options-settings',
    ));
}
