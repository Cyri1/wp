<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="my-3 clearfix">
            <?php if (get_post_meta(get_the_ID(), CustomMetaBox::META_KEY, true) === '1') : ?>
                <div class="alert alert-warning">Custom box cochée</div>
            <?php endif ?>
            <div class="mx-4 me-5">
                <h3 class="card-title mt-3"><?php the_title(); ?></h3>
            </div>
            <div>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="col-md-6">
                        <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid float-start m-3', 'alt' => ''])  ?>
                    </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        <?php if (comments_open() || get_comments_number()) {
            comments_template();
        } ?>
    <?php endwhile; ?>
<?php else : ?>
    <h1>Pas d'article</h1>
<?php endif; ?>
<?php get_footer(); ?>