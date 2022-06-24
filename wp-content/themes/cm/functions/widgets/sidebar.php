<?php 

require_once 'custom.php';

add_action('widgets_init', 'tm_register_widget');

function tm_register_widget() {
    register_widget(CustomWidget::class);
    register_sidebar([
        'id' => 'homepage',
        'name' => 'Sidebar Homepage',
        'before_widget' => '<br><div class="p-1 %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="font-italic">',
        'after_title' => '</h4>',
    ]);
}

?>