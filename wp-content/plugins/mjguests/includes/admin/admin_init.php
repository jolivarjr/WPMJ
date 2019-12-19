<?php

include 'metabox_mj_guests_convidados.php';
include 'metabox_mj_guests_relatorio.php';
include 'enqueue.php';
include 'mj_save_guests.php';
include 'mj_del_guests.php';

function mj_guests_admin_init()
{
    add_action('add_meta_boxes_mjguests', 'mj_guests_metaboxes');
    add_action('admin_enqueue_scripts', 'mj_admin_enqueue');

    add_action('wp_ajax_mj_save_guests', 'mj_save_guests');
    add_action('wp_ajax_nopriv_mj_save_guests', 'mj_save_guests');

    add_action('wp_ajax_mj_del_guests', 'mj_del_guests');
    add_action('wp_ajax_nopriv_mj_del_guests', 'mj_del_guests');
}

function mj_guests_metaboxes()
{
    add_meta_box(
        'mj_guests_convidados',
        'Convidados',
        'mj_guests_convidados',
        'mjguests',
        'normal',
        'high'
    );
    add_meta_box(
        'mj_guests_relatorio',
        'Relatórios',
        'mj_guests_relatorio',
        'mjguests',
        'side',
        'low'
    );
}

function mj_save_posts_admin($post_id, $post, $update)
{

    if (!$update) {
        return;
    }

    /** SALVA METADADOS
     * $mjguests_dados = ['campo_x' => $_POST["campo_x"]];
     * 
     * update_post_meta($post_id, 'mjguests_dados', $mjguests_dados);
     */
}
