<?php

/** CUIDA DAS IMAGENS **/
function jg_delete_gallery()
{
    global $wpdb;
    $res = false;

    $img_id = absint($_POST['img_id']);

    // Pega o nome da imagem no banco para ser apagado o arquivo
    $img_name = $wpdb->get_row("SELECT nome FROM " . $wpdb->prefix . "jotagalleries WHERE ID = {$img_id}", ARRAY_A)['nome'];

    // Apaga no banco de dados
    $res = $wpdb->delete($wpdb->prefix . "jotagalleries", ['ID' => $img_id]);

    if ($res) {
        wp_delete_file(WP_CONTENT_DIR  . "/uploads/jgallery/" . $img_name);
        wp_delete_file(WP_CONTENT_DIR  . "/uploads/jgallery/min/" . $img_name);
    }

    echo $res;

    die();
}
