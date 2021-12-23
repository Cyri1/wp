<?php

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

function tm_custom_excerpt_length($length)
{
    return 150;
}

function tm_menu_class($classes)
{
    $classes[] = 'nav-item';
    return $classes;
}

function tm_menu_link_class($attr)
{
    $attr['class'] = 'nav-link';
    return $attr;
}

function tm_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if (!$pages) {
        return;
    }
    echo '<nav aria-label="Pagination">';
    echo '<ul class="pagination pagination-sm">';
    foreach ($pages as $page) {
        $active = strpos($page, 'current') ? 'active' : '';
        echo '<li class="page-item '. $active .'">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

add_action('after_setup_theme', 'tm_supports');
add_action('wp_enqueue_scripts', 'tm_register_assets');
add_filter('excerpt_length', 'tm_custom_excerpt_length', 999);
add_filter('nav_menu_css_class', 'tm_menu_class');
add_filter('nav_menu_link_attributes', 'tm_menu_link_class');

require_once('metaboxes/custom.php');
CustomMetaBox::register();  