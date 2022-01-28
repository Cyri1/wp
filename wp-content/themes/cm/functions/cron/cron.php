<?php 
add_action('tm_import_content', function () {
    //do something
});

//register new interval
add_filter('cron_schedules', function ($schedules) {
    $schedules['ten_seconds'] = [
        'interval' => 10,
        'display' => 'every 10 seconds',
    ];
    return $schedules;
});

// wp-config.php define('DISABLE_WP_CRON');  // disable default behavior > visitor launch cron,
// localhost/wp-cron.php // endpoint to manualy launch cron jobs

// register new cron
// if (!wp_next_scheduled('tm_import_content')) {
//     wp_schedule_event(time(),'hourly', 'tm_import_content');
// }

//unregister cron
// if ($timestamp = wp_next_scheduled('tm_import_content')) {
//     wp_unschedule_event($timestamp, 'tm_import_content');
// }

// display registered crons
// echo '<pre>';
// var_dump(_get_cron_array());
// echo '</pre>';
// die;

