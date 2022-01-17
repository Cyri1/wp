<?php

add_action('init', 'tm_init');
add_action('after_setup_theme', 'tm_supports');
add_action('wp_enqueue_scripts', 'tm_register_assets');
add_action('admin_enqueue_scripts', 'tm_register_admin_assets');

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
    register_nav_menu('header', 'Entête du menu');
}

function tm_register_assets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', []);
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', ['jquery', 'popper'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', [], false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

function tm_register_admin_assets()
{
    wp_register_script('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr', [], false, true);
    wp_register_style('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css');
    wp_enqueue_style('flatpickr');
    wp_enqueue_script('tm_custom_admin_js', get_template_directory_uri() . '/assets/custom-admin.js', ['flatpickr'], false, true);
    wp_enqueue_style('tm_custom_admin_css', get_template_directory_uri() . '/assets/custom-admin.css');
}

require_once('functions/navbar/navbar.php');
require_once('functions/excerpt/excerpt.php');
require_once('functions/metaboxes/custom.php');
require_once('functions/settings-options/custom.php');
require_once('functions/pagination/pagination.php');
require_once('functions/filter-posts/filter.php');
require_once('functions/widgets/widgets.php');