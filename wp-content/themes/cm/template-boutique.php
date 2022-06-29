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
?>
<div class="row">
    <?php if ($loop->have_posts()) : ?>
        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
            <div class="card m-3" style="width: 18rem;">
            <div class="text-center p-2">
                <?= the_post_thumbnail('maxi_image'); ?>
            </div>
                <div class="card-body">
                    <h6 class="card-title"><?php the_title() ?></h6>
                    <p class="card-text"><strong>Prix : <?= the_field('prix'); ?> €</strong></p>
                    <a href="<?=the_field('lien_helloasso')?>" target="_blank" class="btn btn-primary">Acheter</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <h1>Pas d'article à vendre pour le moment</h1>
    <?php endif; ?>
</div>

<?php get_footer(); ?>