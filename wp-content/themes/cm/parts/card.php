<div class="card my-3 shadow-sm">
    <div class="mx-3">
        <h4 class="card-title mt-3"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
        <?php $taxonomies = get_the_terms(get_the_ID(), 'custom_taxonomy') ? get_the_terms(get_the_ID(), 'custom_taxonomy') : []; ?>
        <ul class="nav nav-pills">
            <?php foreach ($taxonomies as $taxonomy) : ?>
                <li>
                    <a href="<?= get_term_link($taxonomy) ?>" class="badge badge-success m-1"><?= $taxonomy->name ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
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