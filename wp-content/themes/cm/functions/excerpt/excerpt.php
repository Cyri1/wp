<?php
function tm_custom_excerpt_length($length)
{
    return 150;
}
add_filter('excerpt_length', 'tm_custom_excerpt_length', 999);