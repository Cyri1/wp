<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-start" tabindex="-1" id="primaryNav">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Bootstrap <small>on</small> WordPress</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <a class="navbar-brand d-none d-lg-inline-flex" href="<?= network_site_url('/') ?>">
                        <?= get_bloginfo('name') ?>
                    </a>
                    <?php
                    wp_nav_menu([
                        'menu'              => 'primary',
                        'theme_location'    => 'primary',
                        'depth'             => 2,
                        'container'            => false,
                        'menu_class'        => 'navbar-nav justify-content-start flex-grow-1 pe-3',
                        'fallback_cb'       => '__return_false',
                        'walker'             => new bootstrap_5_wp_nav_menu_walker()
                    ]);
                    ?>
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">