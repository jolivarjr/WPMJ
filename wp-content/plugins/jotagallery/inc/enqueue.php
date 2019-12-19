<?php

function jg_enqueue_scripts()
{
    wp_register_style(
        'style-front',
        plugins_url('/assets/css/style-front.css', JGALLERY_URL)
    );

    wp_register_script(
        'script-front',
        plugins_url('/assets/js/script-front.js', JGALLERY_URL),
        ['jquery'],
        '1.0',
        true
    );

    wp_enqueue_style('style-front');
    wp_enqueue_script('script-front');
}
