<?php

function mj_activate_plugin()
{
    if (version_compare(get_bloginfo('version'), '5.0', '<')) {
        wp_die(__('Você precisa atualizar a versão do WordPress', 'mjguests'));
    }

    global $wpdb;

    $sql = "CREATE TABLE " . $wpdb->prefix . "mjguests (
        ID int(11) NOT NULL AUTO_INCREMENT,
        gpguests_id int(11) NOT NULL,
        nome varchar(255) NOT NULL,
        qtd_pessoas varchar(255) DEFAULT '0',
        codigo varchar(100) NOT NULL,
        status varchar(100) NOT NULL,
        data timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        desativado varchar(1) NOT NULL DEFAULT '0',
        PRIMARY KEY (ID)
    )" . $wpdb->get_charset_collate();

    require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
