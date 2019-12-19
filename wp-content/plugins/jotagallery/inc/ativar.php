<?php

function jg_ativar_plugin()
{
    if (version_compare(get_bloginfo('version'), '5.0', '<')) {
        wp_die(__('Você precisa atualizar o WordPress para usar este plugin', 'jotagallery'));
    }

    global $wpdb;

    $sql = "CREATE TABLE " . $wpdb->prefix . "jotagalleries (
        ID BIGINT(20) NOT NULL AUTO_INCREMENT,
        jotagallery_id BIGINT(20),
        nome VARCHAR(100) NOT NULL,
        descricao VARCHAR(255) NOT NULL,
        formato VARCHAR(5) NOT NULL,
        tamanho INT(11) NOT NULL,
        publicada INT(1) DEFAULT 0,
        PRIMARY KEY (ID)
    )" . $wpdb->get_charset_collate();

    require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
