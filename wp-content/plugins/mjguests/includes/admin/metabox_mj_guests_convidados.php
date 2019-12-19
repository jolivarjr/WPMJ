<?php

function mj_guests_convidados($post)
{
    /** PEGANDO META DADOS
     * 
     * $mjguests_dados = get_post_meta($post->ID, 'mjguests_dados', true);
     * 
     * if(empty($mjguests_dados)){
     *      $mjguests_dados = ['campo_x' => '']
     * }
     * 
     * <?= $mjguests_dados['campo_x'] ?>
     */

    global $wpdb;

    $guests = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "mjguests WHERE gpguests_id = $post->ID AND desativado = 0 ORDER BY data DESC", ARRAY_A);
    ?>

    <div class="container">
        <div class="row">
            <button id="add_guest">Adicionar</button>
        </div>
        <hr>
        <div class="row" id="rowGuests">

            <input id="gpguests_id" type="hidden" value="<?= $post->ID ?>">

            <div class="form">

                <?php
                if (count($guests) > 0) : foreach ($guests as $guest) :

                        switch ($guest['status']) {
                            case "Presente":
                                $status_class = "green";
                                break;
                            case "Ausente":
                                $status_class = "red";
                                break;
                            default:
                                $status_class = "gray";
                                break;
                        }

                        $dtConfirm = new DateTime($guest['data']);
                        ?>

                        <div class="guest" id="<?= $guest['ID'] ?>">
                            <input type="text" name="nome" value="<?= $guest['nome'] ?>">

                            <input type="text" name="qtd_pessoas" value="<?= $guest['qtd_pessoas'] ?>">

                            <input type="text" name="codigo" value="<?= $guest['codigo'] ?>" readonly>

                            <input type="text" name="status" value="<?= $guest['status'] ?>" class="<?= $status_class ?>">

                            <input type="text" name="data" value="<?= $dtConfirm->format('d/m/Y h:i:s') ?>" readonly>

                            <button class="clearField">X</button>
                        </div>

                    <?php
                    endforeach;
                else :
                    ?>

                    <div class="guest" id="0">
                        <input type="text" name="nome" placeholder="Nome">

                        <input type="text" name="qtd_pessoas" placeholder="Qtd. Pessoas">

                        <input type="text" name="codigo" readonly placeholder="Código">

                        <input type="text" name="status" placeholder="Status">

                        <input type="text" name="data" placeholder="Data..." readonly>

                        <button class="clearField">X</button>
                    </div>

                <?php
                endif;
                ?>
            </div>
            <hr>
            <button id="save_guests">Salvar</button>
            <div class="loader">
                <img width="70" src='<?= MJGUESTS_BASE_URL ?>/assets/img/load.gif'>
            </div>
        </div>
    </div>

<?php
}
