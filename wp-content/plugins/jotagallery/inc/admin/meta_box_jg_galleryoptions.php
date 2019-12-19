<?php

function jg_galleryoptions($post)
{
    global $wpdb;

    $photos = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jotagalleries WHERE jotagallery_id = $post->ID", ARRAY_A);

    ?>

    <div class="content-jgallery">

        <input id="gallery_id" type="hidden" value="<?= $post->ID ?>">

        Select images: <input id="imgsJgallery" type="file" name="files[]" multiple>
        <button id="btSendJg">Enviar imagens</button>

        <div class="loader">
            <img id="gifJg" src='<?= JGALLERY_BASE_URL ?>/assets/images/load.gif'>
        </div>

        <hr>

        <div id="resultJg">
            <?php
            if (count($photos) > 0) {
                foreach ($photos as $photo) :
                    ?>
                    <div class="img">
                        <span class="deleteJg" title="Excluir Imagem">X</span>
                        <img id="<?= $photo['ID']  ?>" src="<?= wp_get_upload_dir()['baseurl'] ?>/jgallery/min/<?= $photo['nome'] ?>">
                    </div>
                <?php
            endforeach;
        }
        ?>
        </div>
    </div>

<?php
}
