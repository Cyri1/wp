<?php 
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

add_filter('nav_menu_css_class', 'tm_menu_class');
add_filter('nav_menu_link_attributes', 'tm_menu_link_class');

?>