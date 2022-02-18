<?php

add_action('init', 'tm_init');
add_action('after_setup_theme', 'tm_supports');
add_action('wp_enqueue_scripts', 'tm_register_assets');
add_action('admin_enqueue_scripts', 'tm_register_admin_assets');
add_action('wp_login_failed', 'tm_login_failed');

function tm_init()
{
    register_taxonomy('custom_taxonomy', 'post', [
        'labels' => [
            'name' => 'Custom Taxonomy',
            'singular_name' => 'Custom Taxonomy',
            'plural_name' => 'Custom Taxonomies',
            'search_items' => 'Rechercher Taxonomy',
            'all_items' => 'Toutes les Taxonomies',
            'edit_item' => 'Editer la Taxonomy',
            'update_item' => 'Mettre à jour la Taxonomy',
            'add_new_item' => 'Ajouter une nouvelle Taxonomy (item)',
            'new_item_name' => 'Ajouter une nouvelle Taxonomy (name)',
            'menu_name' => 'Custom Taxonomy',
        ],
        'show_in_rest' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
    ]);
}

function tm_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
}

function tm_register_assets()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', []);
    wp_register_style('style', get_template_directory_uri() . '/style.css', []);
    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', ['jquery'], false, true);
    wp_register_script('tm_custom', get_template_directory_uri() . '/js/custom.js', [], false, true);
    wp_register_script('validatorjs', 'https://unpkg.com/validator@latest/validator.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', [], false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('style');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('tm_custom');
    wp_enqueue_script('validatorjs');
}

function tm_register_admin_assets()
{
    wp_register_script('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr', [], false, true);
    wp_register_style('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css');
    wp_enqueue_style('flatpickr');
    wp_enqueue_script('tm_custom_admin_js', get_template_directory_uri() . '/js/custom-admin.js', ['flatpickr'], false, true);
    wp_enqueue_style('tm_custom_admin_css', get_template_directory_uri() . '/css/custom-admin.css');
}

function tm_login_failed()
{
    $referrer = $_SERVER['HTTP_REFERER'];
    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        $param = strpos('?login=failed', $_SERVER['REQUEST_URI']) ? '' : '?login=failed';
        wp_redirect(home_url() . $param);
        exit;
    }
}

require_once('functions/navbar/navbar.php');
require_once('functions/excerpt/excerpt.php');
require_once('functions/metaboxes/custom.php');
require_once('functions/settings-options/custom.php');
require_once('functions/pagination/pagination.php');
require_once('functions/filter-posts/filter.php');
require_once('functions/widgets/sidebar.php');
require_once('functions/widgets/custom.php');
require_once('functions/comments/comments.php');
require_once('functions/appearance/appearance.php');
require_once('functions/cron/cron.php');
require_once('functions/wpdb/wpdb.php');
