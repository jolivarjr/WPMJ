<?php

function mj_guests_relatorio($post)
{
    global $wpdb;

    $reports = $wpdb->get_row(
        "
    SELECT 
        count(ID) as total_convidados, 
        sum(qtd_pessoas) as total_acompanhantes, 
        (count(ID) + sum(qtd_pessoas)) as total_pessoas,
        (SELECT count(ID) FROM " . $wpdb->prefix . "mjguests WHERE status = 'Presente' AND gpguests_id = $post->ID AND desativado = 0) as presentes,
        ((SELECT count(ID) FROM " . $wpdb->prefix . "mjguests WHERE status = 'Presente' AND gpguests_id = $post->ID AND desativado = 0) + ((SELECT sum(qtd_pessoas) FROM " . $wpdb->prefix . "mjguests WHERE status = 'Presente' AND gpguests_id = $post->ID AND desativado = 0))) as total_presentes,
        (SELECT count(ID) FROM " . $wpdb->prefix . "mjguests WHERE status = 'Ausente' AND gpguests_id = $post->ID AND desativado = 0) as ausentes, 
        ((SELECT count(ID) FROM " . $wpdb->prefix . "mjguests WHERE status = 'Ausente' AND gpguests_id = $post->ID AND desativado = 0) + ((SELECT sum(qtd_pessoas) FROM " . $wpdb->prefix . "mjguests WHERE status = 'Ausente' AND gpguests_id = $post->ID AND desativado = 0))) as total_ausentes
    FROM " . $wpdb->prefix . "mjguests 
    WHERE 
        gpguests_id = $post->ID AND desativado = 0",
        ARRAY_A
    );

    $desativados = $wpdb->get_row(
        "
    SELECT 
        count(desativado) as desativados 
    FROM " . $wpdb->prefix . "mjguests 
    WHERE 
        desativado = 1 AND gpguests_id = $post->ID",
        ARRAY_A
    );

    ?>

    <div class="container">
        <div class="row">
            <div class="col green">Presentes: [ <?= $reports['presentes'] ?? 0 ?> ]</div>
            <div class="col green">(Presentes + Acompanhantes): [<span class="destaque"><?= $reports['total_presentes'] ?? 0 ?></span>&nbsp;]</div>
            <hr>
            <div class="col red">Ausentes: [ <?= $reports['ausentes'] ?? 0 ?> ]</div>
            <div class="col red">(Ausentes + Acompanhantes): [ <?= $reports['total_ausentes'] ?? 0 ?> ]</div>
            <hr>
            <div class="col blue">Total de Convidados: [ <?= $reports['total_convidados'] ?? 0 ?> ]</div>
            <div class="col blue">Total de Acompanhantes: [ <?= $reports['total_acompanhantes'] ?? 0 ?> ]</div>
            <div class="col blue">(Convidados + Acompanhantes): [ <?= $reports['total_pessoas'] ?? 0 ?> ]</div>
            <hr>
            <div class="col gray">Desativados: [ <?= $desativados['desativados'] ?? 0  ?> ]</div>
        </div>
    </div>

<?php
}
