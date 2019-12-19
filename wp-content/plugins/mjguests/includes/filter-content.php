<?php

function mj_filter_content($content)
{

    if (!is_singular('mjguests')) {
        return $content;
    }

    global $post;

    $template = file_get_contents('filter-template.php', true);
    $template = str_replace('{{dados_template}}', $post->post_title, $template);

    return $template . $content;
}
