<?php get_header(); ?>

<div class="row">

    <div class="col-md-8 blog-main">
        <h2>Bienvenue sur le site de Bad'Iroise Saint-Renan</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ullam nulla error sed quas, fuga velit eligendi commodi magni ex quod totam, perspiciatis eaque provident perferendis, dignissimos eius consectetur dolores tempore aliquam. Voluptates hic error, repellat autem ipsa ab modi, placeat dicta ex eum officiis nostrum molestiae ut iste deleniti provident soluta praesentium ad quos doloribus! Saepe consequatur ex voluptates libero! Commodi laborum aliquid vero aliquam doloremque aspernatur, sequi animi repellat dolore nostrum. Error voluptate quod laudantium nihil! Fugiat, earum, veritatis tempora commodi consequuntur vitae fuga minus saepe quaerat a repellendus provident non harum illum, facere minima neque. A, officiis!</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ullam nulla error sed quas, fuga velit eligendi commodi magni ex quod totam, perspiciatis eaque provident perferendis, dignissimos eius consectetur dolores tempore aliquam. Voluptates hic error, repellat autem ipsa ab modi, placeat dicta ex eum officiis nostrum molestiae ut iste deleniti provident soluta praesentium ad quos doloribus! Saepe consequatur ex voluptates libero! Commodi laborum aliquid vero aliquam doloremque aspernatur, sequi animi repellat dolore nostrum. Error voluptate quod laudantium nihil! Fugiat, earum, veritatis tempora commodi consequuntur vitae fuga minus saepe quaerat a repellendus provident non harum illum, facere minima neque. A, officiis!</p>
    </div>

    <?php if (is_active_sidebar('homepage')) : ?>
        <?php $allWidgets = wp_get_sidebars_widgets() ?>
        <?php if ($allWidgets['homepage']) : ?>
            <aside class="col-md-4 blog-sidebar p-3">
                <ul class="list-unstyled">
                <li><?php get_search_form(); ?></li>
                <?= get_sidebar('homepage') ?>
                </ul>
            </aside>
        <?php endif; ?>
    <?php endif; ?>

</div>

<?php get_footer(); ?>