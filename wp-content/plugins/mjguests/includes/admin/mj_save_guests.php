<?php

date_default_timezone_set('America/Sao_Paulo');

function mj_save_guests()
{
    global $wpdb;
    $result = ['guests' => 0, 'updEqual' => 0];

    if (!empty($_POST['guests'])) {

        $guests = $_POST['guests'];
        $gpguests_id = $_POST['gpguests_id'];

        $final = [];
        foreach ($guests as $guest) {

            if (isset($guest['byCode']) && $guest['byCode'] == 1) {
                $guestByCode = $wpdb->get_row("SELECT ID FROM {$wpdb->prefix}mjguests WHERE ID = '{$guest['codigo']}'", ARRAY_A);

                if (count($guestByCode) > 0) $guest['ID'] = $guestByCode['ID'];
            }

            if (isset($guest['nome']) && !empty($guest['nome'])) {
                $guestByName = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}mjguests WHERE nome = '{$guest['nome']}'", ARRAY_A);

                if (count($guestByName) > 0) $guest['ID'] = $guestByName['ID'];

                if ($guest['nome'] == $guestByName['nome'] && $guest['qtd_pessoas'] == $guestByName['qtd_pessoas'] && $guest['status'] == $guestByName['status']) {
                    $result['updEqual'] = 1;
                }
            }

            if (empty($guest['ID'])) {

                /** SALVA NO BANCO **/
                $wpdb->insert(
                    $wpdb->prefix . 'mjguests',
                    array(
                        'gpguests_id' => $gpguests_id,
                        'nome' => $guest['nome'],
                        'qtd_pessoas' => $guest['qtd_pessoas'],
                        'codigo' => $guest['codigo'],
                        'status' => $guest['status'],
                    )
                );

                $insert = $wpdb->insert_id;
                $guest['ID'] = $wpdb->insert_id;
            } else {
                /** ATUALIZA NO BANCO **/
                $insert = $wpdb->update(
                    $wpdb->prefix . 'mjguests',
                    array(
                        'nome' => $guest['nome'],
                        'qtd_pessoas' => $guest['qtd_pessoas'],
                        'status' => $guest['status']
                    ),
                    array('ID' => $guest['ID'])
                );
            }

            if ($insert) {
                $final[] = [
                    'ID' => $guest['ID'],
                    'nome' => $guest['nome'],
                    'qtd_pessoas' => $guest['qtd_pessoas'],
                    'codigo' => $guest['codigo'],
                    'status' => $guest['status'],
                    'data' => Date('d/m/Y H:i:s'),
                ];
            }
        }
    }

    if (count($final) > 0) {
        $result['guests'] = $final;
    }

    echo json_encode($result, true);

    exit;
}
