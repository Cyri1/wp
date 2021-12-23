<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <div class="card my-3 shadow-sm">
            <div class="mx-3">
                <h4 class="card-title mt-3"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                <h6 class="card-subtitle mb-2 text-muted"><?php the_category(); ?></h6>
            </div>
            <div class="row m-0">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="col-md-3 m-2 p-0">
                        <?php the_post_thumbnail('medium', ['class' => 'card-img-top shadow-sm h-auto ', 'alt' => ''])  ?>
                    </div>
                <?php endif; ?>
                <div class="col-md p-0">
                    <div class="card-text px-2"><?php the_excerpt(); ?></div>
                </div>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated XXXX</small>
            </div>
        </div>
    <?php endwhile; ?>
    <?php tm_pagination() ?>
    <?php else : ?>
    <h1>Pas d'article</h1>
<?php endif; ?>
<?php get_footer(); ?>