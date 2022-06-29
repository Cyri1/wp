<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">
    <div>
        <div class="bg-primary">
            <div class="container">
                <img class="img-fluid" src="<?= get_template_directory_uri(); ?>/assets/logo.png" width="600" height="200" alt="logo">
            </div>
        </div>
        <nav class="container navbar navbar-expand-lg navbar-light bg-white border-bottom border-primary border-2 shadow-sm">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-start" tabindex="-1" id="primaryNav">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <a class="navbar-brand d-none d-lg-inline-flex" href="<?= network_site_url('/') ?>">
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
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarLogin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Mon compte
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                <?php if (is_user_logged_in()) : ?>
                                    <a class="dropdown-item" href="<?= esc_url(home_url('/mes-informations')) ?>">Mes informations</a>
                                    <a class="dropdown-item" href="<?= wp_logout_url(get_permalink()) ?>')) ?>">Se déconnecter</a>
                                    <?php else : ?>
                                    <form class="px-4 py-3" name="loginform" id="loginform" action="<?= wp_login_url() ?>" method="post">
                                        <div class="mb-3">
                                            <label for="exampleDropdownFormEmail1" class="form-label">Identifiant ou e-mail :</label>
                                            <input name="log" class="form-control" id="exampleDropdownFormEmail1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleDropdownFormPassword1" class="form-label">Mot de passe :</label>
                                            <input type="password" name="pwd" class="form-control" id="exampleDropdownFormPassword1" autocomplete="on">
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" name="rememberme" value="forever" class="form-check-input" id="dropdownCheck">
                                                <input type="hidden" name="redirect_to" value="<?= home_url() ?>">
                                                <label class="form-check-label" for="dropdownCheck">Se souvenir de moi</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Se connecter</button>
                                    </form>
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="<?= esc_url(home_url('/creer-un-compte')) ?>">Créer un compte</a>
                                    <a class="dropdown-item" href="<?php echo esc_url(wp_lostpassword_url(get_home_url())); ?>" alt="<?php esc_attr_e('Lost Password', 'textdomain'); ?>">
                                        <?php esc_html_e('Lost Password', 'textdomain'); ?>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php get_template_part('parts/failed-login'); ?>
        </nav>
    </div>
    <div class="container bg-white flex-fill p-3">