<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('parts/card', 'post') ?>
    <?php endwhile; ?>
    <?php tm_pagination() ?>
<?php else : ?>
    <h1>Pas d'article</h1>
<?php endif; ?>
<?php get_footer(); ?>