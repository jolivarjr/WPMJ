<?php

function jg_filter_jgallery_content($content)
{
    if (!is_singular('jotagallery')) {
        return $content;
    }

    global $post;

    $jgallery_html = file_get_contents('jotagallery-template.php', true);
    // $jgallery_data = get_post_meta($post->ID, 'jgallery_data', true);

    $jgallery_html = str_replace('{{gallery_id}}', $post->ID, $jgallery_html);

    return $jgallery_html . $content;
}
