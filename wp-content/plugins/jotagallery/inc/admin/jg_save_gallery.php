<?php

/** CUIDA DAS IMAGENS **/
function jg_save_gallery()
{
    global $wpdb;

    $output = [];
    $i = 1;

    $gallery_id = isset($_POST['gallery_id']) ? absint($_POST['gallery_id']) : null;

    if (is_array($_FILES)) {
        foreach ($_FILES as $jImage) {
            $file_name = explode('.', substr($jImage['name'], -5));
            $allowed_ext = ['jpg', 'png', 'jpeg', 'gif'];

            if (in_array($file_name[1], $allowed_ext)) {
                $new_name = md5(rand()) . '.' . $file_name[1];
                $source_path = $jImage['tmp_name'];
                $target_path = WP_CONTENT_DIR  . "/uploads/jgallery/" . $new_name;

                if (!is_dir(WP_CONTENT_DIR  . "/uploads/jgallery/")) wp_mkdir_p(WP_CONTENT_DIR  . "/uploads/jgallery/");

                if (move_uploaded_file($source_path, $target_path)) {

                    /** SALVA NO BANCO **/
                    $wpdb->insert(
                        $wpdb->prefix . 'jotagalleries',
                        array(
                            'jotagallery_id' => $gallery_id,
                            'nome' => $new_name,
                            'descricao' => $jImage['name'],
                            'formato' => $file_name[1],
                            'tamanho' => $jImage['size']
                        )
                    );

                    recorte($target_path, $new_name);
                    $output[] = [
                        'src' => wp_get_upload_dir()['baseurl'] . "/jgallery/min/" . $new_name,
                        'img_id' => $wpdb->insert_id
                    ];
                }
            }
            $i++;
        }

        wp_send_json($output);
    }

    die();
}

function recorte($archive, $name_img)
{
    $type = explode('.', substr($archive, -5))[1];

    $width = 800;
    $height = 800;
    $ratio = $width / $height;

    list($width_origin, $height_origin) = getimagesize($archive);

    $ratio_origin = $width_origin / $height_origin;

    if ($ratio > $ratio_origin) {
        $width = $height * $ratio_origin;
    } else {
        $height = $width / $ratio_origin;
    }

    $image_final = imagecreatetruecolor($width, $height);
    if (!is_dir(WP_CONTENT_DIR  . "/uploads/jgallery/min")) wp_mkdir_p(WP_CONTENT_DIR  . "/uploads/jgallery/min");

    switch ($type) {
        case 'jpg':
        case 'jpeg':

            $image_origin = imagecreatefromjpeg($archive);
            imagecopyresampled(
                $image_final,
                $image_origin,
                0,
                0,
                0,
                0,
                $width,
                $height,
                $width_origin,
                $height_origin
            );
            imagejpeg($image_final, WP_CONTENT_DIR  . "/uploads/jgallery/min/"  . $name_img, 80);

            break;
        case 'png':

            $image_origin = imagecreatefrompng($archive);
            imagecopyresampled(
                $image_final,
                $image_origin,
                0,
                0,
                0,
                0,
                $width,
                $height,
                $width_origin,
                $height_origin
            );
            imagepng($image_final, WP_CONTENT_DIR  . "/uploads/jgallery/min/"  . $name_img);

            break;
    }
}
