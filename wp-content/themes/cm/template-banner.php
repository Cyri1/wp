<?php 
/**
 * Template Name: Page avec bannière
 * Template Post Type: page, post
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="my-3">
            <div class="mx-4 mr-5">
                <h1>>>>>>>>>>>Une bannière!<<<<<<<<<<<</h1>
                <h3 class="card-title mt-3"><?php the_title(); ?></h3>
            </div>
            <div>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="col-md-6">
                        <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid float-left m-3', 'alt' => ''])  ?>
                    </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php else : ?>
    <h1>Pas d'article</h1>
<?php endif; ?>
<?php get_footer(); ?>