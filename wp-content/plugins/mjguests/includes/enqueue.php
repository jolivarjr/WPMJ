<?php

function mj_front_enqueue()
{
    
    // Registros
    wp_register_style(
        'mj_front_css',
        plugins_url('/assets/css/front.css', MJGUESTS_URL)
    );

    wp_register_script(
        'mj_front_script',
        plugins_url('/assets/js/front.js', MJGUESTS_URL),
        ['jquery'],
        '1.0',
        true
    );

    wp_localize_script('mj_front_script', 'mj_object', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);

    // Usos
    wp_enqueue_style('mj_front_css');
    wp_enqueue_script('mj_front_script');
}
