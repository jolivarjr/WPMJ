<?php

/*
 * Plugin Name: MJ Guests
 * Description: Guests List
 * Version: 1.0
 * Author: Jolivar Jr.
 * Author URI: https://github.com/jolivarjr
 * Text Domain: mjguests 
 * 
 * criar grupo com nome Main, é o grupo padrão que o plugin vai inserir os convidados confirmados pelo popup no front-end
 * criar um botão ou item no menu com id "guest_codigo" para abrir o popup de confirmação
 */

if (!function_exists('add_action')) {
    echo "Ação Ilegal";
    exit;
}

// SETUP
define('MJGUESTS_URL', __FILE__);
define('MJGUESTS_BASE_URL', plugin_dir_url(__FILE__));

// INCLUDES
include('hooks-personalizados.php');
include('includes/activate.php');
include('includes/init.php');
include('includes/admin/admin_init.php');
include('includes/filter-content.php');
include('includes/enqueue.php');

// HOOKS
register_activation_hook(MJGUESTS_URL, 'mj_activate_plugin');
add_action('init', 'mj_guests_init');
add_action('admin_init', 'mj_guests_admin_init');
add_action('save_post_mjguests', 'mj_save_posts_admin', 10, 3);
add_filter('the_content', 'mj_filter_content');
add_action('wp_enqueue_scripts', 'mj_front_enqueue', 100);

 // SHORTCODES
