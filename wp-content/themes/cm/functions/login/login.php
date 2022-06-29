<?php
function tm_login_failed()
{
    $referrer = $_SERVER['HTTP_REFERER'];
    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        $param = strpos('?login=failed', $_SERVER['REQUEST_URI']) ? '' : '?login=failed';
        wp_redirect(home_url() . $param);
        exit;
    }
}

function tm_login_successful()
{
    wp_redirect(home_url());
    exit;
}

function tm_user_created()
{
    wp_redirect(home_url());
    exit;
}

function tm_login_empty($username, $pwd)
{
    if (empty($username) || empty($pwd)) {
        wp_safe_redirect(home_url());
        exit();
    }
}


do_action( 'user_register', 'tm_user_created');
add_action('wp_login_failed', 'tm_login_failed');
add_action('wp_login', 'tm_login_successful');
add_action('wp_authenticate', 'tm_login_empty', 1, 2);