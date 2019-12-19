<?php


function popup_convite()
{
    $close_guess_popup = ($_COOKIE['close_guess_popup'] == '_clicou_') ? 'none' : 'flex';
    $guest_codigo = ($_COOKIE['guest_codigo'] != '') ? $_COOKIE['guest_codigo'] : '0';
    $guest_nome = ($_COOKIE['guest_nome'] != '') ? $_COOKIE['guest_nome'] : '';
    $guest_acompanhantes = ($_COOKIE['guest_acompanhantes'] != '') ? $_COOKIE['guest_acompanhantes'] : '0';
    $vou = ($_COOKIE['guest_status'] == 'Presente') ? 'checked' : '';
    $naovou = ($_COOKIE['guest_status'] == 'Ausente') ? 'checked' : '';

    $grupo_especifico = get_posts(array(
        'fields'          => 'ids',
        'title'          => 'Main',
        'numberposts' => 1,
        'post_type' => 'mjguests'
    ));

    if (count($grupo_especifico) > 0) {
        $gp_id = $grupo_especifico[0];
    } else {
        $gp_id = 999;
    }
    ?>

    <div class="mj_popup" style="display:<?= $close_guess_popup ?>">
        <div class="close">X</div>

        <div class="confirm">

            <input type="hidden" id="gp_id" value="<?= $gp_id ?>">
            <input type="hidden" id="guest_codigo" value="<?= $guest_codigo ?>">

            <span>Confirme Sua Presença no Evento</span>
            <div class="buttons">

                <div class="mj_boxform">
                    <label for="mj_vou">
                        <input id="mj_vou" type="radio" value="Presente" name="ausente" <?= $vou ?>> Eu vou
                    </label>
                    <label for="mj_naovou">
                        <input id="mj_naovou" type="radio" value="Ausente" name="ausente" <?= $naovou ?>> Não poderei comparecer
                    </label>
                </div>

                <div class="mj_boxform boxform_ausente">
                    <label for="nome_convidado">Seu Nome:</label>
                    <input type="text" id="nome_convidado" value="<?= $guest_nome ?>" name="nome_convidado" placeholder="Digite aqui...">
                </div>

                <div class="mj_boxform">
                    <label for="qtd_pessoas" style="width:100%">Quantidade de Acompanhantes:</label>
                    <button id="qtd_less">-</button>
                    <input readonly type="number" id="qtd_pessoas" value="<?= $guest_acompanhantes ?>" name="qtd_pessoas" title="Quantas pessoas irão com você?">
                    <button id="qtd_plus">+</button>
                </div>

                <button id="mj_send">Enviar</button>
            </div>
        </div>
    </div>
<?php
}

add_action('wp_head', 'popup_convite');
