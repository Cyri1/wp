<?php
add_action('widgets_init', 'register_widget_sponsors');

function register_widget_sponsors()
{
    register_widget('widget_sponsors');
}

class widget_sponsors extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'widget_sponsors',
            esc_html__('Widget Sponsors', 'textdomain'),
            array('description' => esc_html__('Affiche les sponsors', 'textdomain'),)
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        $postArgs = array(
            'post_type'      => 'sponsors',
            'posts_per_page' => -1,
        );
        $loop = new WP_Query($postArgs);
        echo '<div><strong>Sponsors du club : </strong></div>';
        echo '<div class="text-center mx-auto">';
        while ($loop->have_posts()) {
            $loop->the_post();
            the_post_thumbnail('mini_image');
        }
        echo '</div>';
        echo $args['after_widget'];
    }
}
