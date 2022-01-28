<?php 
add_action('customize_register', function (WP_Customize_Manager $manager){
    $manager->add_section('tm_appearance', [
        'title' => 'Customize',
    ]);
    
    $manager->add_setting('header_background', [
        'default' => '#FF0000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ]);
    $manager->add_control(new WP_Customize_Color_Control($manager, 'header_background', [
        'section' => 'tm_appearance',
        'label' => 'header color'
    ]));

});

add_action('customize_preview_init', function () {
    wp_enqueue_script('tm_appareace', get_template_directory_uri() . '/js/appearance.js', ['jquery', 'customize-preview'], '', true);
})
// get_theme_mod('header_background')

?>