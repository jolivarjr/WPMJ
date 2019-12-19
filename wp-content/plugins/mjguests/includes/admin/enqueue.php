<?php

function mj_admin_enqueue()
{
    global $typenow;

    if ($typenow != 'mjguests') {
        return;
    }

    // Registros
    wp_register_style(
        'mj_admin_css',
        plugins_url('/assets/css/back.css', MJGUESTS_URL)
    );

    wp_register_script(
        'mj_admin_js',
        plugins_url('/assets/js/back.js', MJGUESTS_URL),
        ['jquery'],
        '',
        true
    );

    // Definindo url AJAX
    wp_localize_script('mj_admin_js', 'mj_object', ['ajax_url' => admin_url('admin-ajax.php')]);

    // Usos 
    wp_enqueue_style('mj_admin_css');
    wp_enqueue_script('mj_admin_js');
}
