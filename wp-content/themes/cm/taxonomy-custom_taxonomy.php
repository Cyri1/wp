<?php get_header(); ?>

<h3><?=get_queried_object()->name ?></h3>
<p><?= get_queried_object()->description?></p>
<ul class="nav nav-pills">
    <?php $taxonomies = get_terms(['taxonomy' => 'custom_taxonomy']) ?>
    <?php foreach ($taxonomies as $taxonomy) : ?>
        <li>
            <a href="<?= get_term_link($taxonomy) ?>" class="nav-link m-2 <?= is_tax('custom_taxonomy', $taxonomy->term_id) ? 'active' : '' ?>"><?= $taxonomy->name ?></a>
        </li>
    <?php endforeach; ?>
</ul>


<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('parts/card', 'post') ?>
    <?php endwhile; ?>
    <?php tm_pagination() ?>
<?php else : ?>
    <h1>Pas d'article</h1>
<?php endif; ?>
<?php get_footer(); ?>