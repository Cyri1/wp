<?php 
add_action('widgets_init', 'tm_register_widget');

function tm_register_widget() {
    register_sidebar([
        'id' => 'homepage',
        'name' => 'Sidebar Homepage',
        // 'before_widget' => '<div class="p-4 %2$s" id="%1$s">', // %1$s >> first parameter (%1) that is a string ($s)
        // 'after_widget' => '</div>',
        // 'before_title' => '<h4 class="font-italic">',
        // 'after_title' => '</h4>',
    ]);
}

?>