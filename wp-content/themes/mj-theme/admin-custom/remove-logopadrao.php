<?php

add_action('admin_bar_menu', 'remove_logo_dash', 100);

function remove_logo_dash($wp_admin_bar)
{
    $wp_admin_bar->remove_node('wp-logo');
}