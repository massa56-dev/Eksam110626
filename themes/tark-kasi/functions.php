<?php
defined('ABSPATH') || exit;

/* ----------------------------------------------------------------
   Theme setup
   ---------------------------------------------------------------- */
add_action('after_setup_theme', function () {
    load_theme_textdomain('tark-kasi', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption']);
    add_theme_support('custom-logo');

    register_nav_menus([
        'primary' => __('Peamine navigatsioon', 'tark-kasi'),
    ]);
});

/* ----------------------------------------------------------------
   Enqueue styles
   ---------------------------------------------------------------- */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'tark-kasi-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );
});

/* ----------------------------------------------------------------
   Excerpt length
   ---------------------------------------------------------------- */
add_filter('excerpt_length', fn() => 25);
add_filter('excerpt_more', fn() => '…');
