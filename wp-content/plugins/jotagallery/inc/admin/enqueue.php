<?php

function jg_admin_enqueue()
{
    global $typenow;

    if ($typenow != 'jotagallery') {
        return;
    }

    //Limpa fotos não utilizadas
    jg_gallery_clear_empty();

    // Registros
    wp_register_style(
        'jg_style',
        plugins_url('/assets/css/jotagallery.css', JGALLERY_URL)
    );

    wp_register_script(
        'jg_script',
        plugins_url('/assets/js/jotagallery.js', JGALLERY_URL),
        ['jquery'],
        '1.0',
        true
    );

    wp_localize_script('jg_script', 'jotagallery_obj', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);

    // Usos
    wp_enqueue_style('jg_style');
    wp_enqueue_script('jg_script');
}

function jg_gallery_clear_empty()
{
    global $wpdb;

    $photos = $wpdb->get_results("SELECT nome FROM " . $wpdb->prefix . "jotagalleries WHERE publicada = 0", ARRAY_A);

    $res = $wpdb->delete($wpdb->prefix . "jotagalleries", ['publicada' => 0]);

    foreach ($photos as $photo) {

        if ($res) {
            wp_delete_file(WP_CONTENT_DIR  . "/uploads/jgallery/" . $photo['nome']);
            wp_delete_file(WP_CONTENT_DIR  . "/uploads/jgallery/min/" . $photo['nome']);
        }
    }
}
