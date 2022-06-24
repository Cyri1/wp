<?php

/**
 * Template Name: Page de la boutique
 * Template Post Type: page
 */
?>

<?php
get_header();
$postArgs = array(
    'post_type'      => 'produits',
    'posts_per_page' => -1,
);
$loop = new WP_Query($postArgs);
while ($loop->have_posts()) {
    $loop->the_post();
    the_post_thumbnail('mini_sponsors');
}

?>

<?php get_footer(); ?>