<?php

function mj_del_guests()
{
    global $wpdb;
    $res = 0;

    if (!empty($_POST['ID'])) {
        $guestID = absint($_POST['ID']);
        // Apaga no banco de dados
        $res = $wpdb->update($wpdb->prefix . "mjguests", ["desativado" => 1], ['ID' => $guestID]);

        echo $res;

        die();
    }
}
