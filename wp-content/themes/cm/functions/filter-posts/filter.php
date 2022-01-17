<?php
function tm_pre_get_posts($query)
{ //example how to use URL params to do sql query
    if (is_admin() || !is_home() || !$query->is_main_query()) {
        return;
    }
    if (get_query_var('custom_param') === 'banner') {
        $meta_query = $query->get('meta-query', []);
        $meta_query[] = [
            'key' => '_wp_page_template', // db key
            'value' => 'template-banner.php', // db value
        ];
        $query->set('meta_query', $meta_query);
    }
}

function tm_query_vars($params)
{ // add param WP will check
    $params[] = 'custom_param';
    return $params;
}

add_action('pre_get_posts', 'tm_pre_get_posts');
add_filter('query_vars', 'tm_query_vars');
