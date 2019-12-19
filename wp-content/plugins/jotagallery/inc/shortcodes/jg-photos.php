<?php

function jg_load_gallery($attrs, $content)
{

    $jg_photos_url = wp_get_upload_dir()['baseurl'] . "/jgallery/";
    $jg_photos_url_min = wp_get_upload_dir()['baseurl'] . "/jgallery/min/";

    extract(shortcode_atts(array(
        'jgallery_id' => false
    ), $attrs));

    // GALERIA ÚNICA
    if ($jgallery_id) {
        global $wpdb;

        $jgalleryHTML = file_get_contents('jg-photos-template-single.php', true);

        $photos = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jotagalleries WHERE jotagallery_id = {$jgallery_id}", ARRAY_A);

        if (count($photos) > 0) {
            $photosHTML = "";
            foreach ($photos as $photo) {
                $photosHTML .= "<figure>";
                $photosHTML .= "<div class='thumby' style='background: url(" . $jg_photos_url_min . $photo['nome'] . ") 
                center / cover no-repeat' data-src='" . $jg_photos_url . $photo['nome'] . "'></div>";
                $photosHTML .= "</figure>";
            }
            $jgalleryHTML = str_replace("{{PHOTOS}}", $photosHTML, $jgalleryHTML);
        } else {
            $jgalleryHTML = str_replace("{{PHOTOS}}", __("<h2 style='width:100%;text-align:center'>There is no Photos Published</h2>", 'jotagallery'), $jgalleryHTML);
        }

        // TODAS AS GALERIAS
    } else {
        $jgalleryHTML = file_get_contents('jg-photos-template-all.php', true);

        $args = [
            'post_type' => 'jotagallery',
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => '10'
        ];

        $galls = new WP_Query($args);

        if ($galls->have_posts()) {

            $galleriesHTML = "";
            while ($galls->have_posts()) : $galls->the_post();
                $galleriesHTML .= "<div class='content_jgallery'>";
                $galleriesHTML .= "<a href='" . get_the_permalink() . "'></a>";
                $galleriesHTML .= "<span class='jg_title'>" . get_the_title() . "</span>";
                $galleriesHTML .= "<img src='" . get_the_post_thumbnail_url() . "' title='" . get_the_title() . "'>";
                $galleriesHTML .= "</div>";
            endwhile;

            $jgalleryHTML = str_replace("{{GALLERIES}}", $galleriesHTML, $jgalleryHTML);
        } else {
            $jgalleryHTML = str_replace("{{GALLERIES}}", __("<h2 style='width:100%;text-align:center'>There is no Galleries</h2>", 'jotagallery'), $jgalleryHTML);
        }
    }

    return $jgalleryHTML;
}
