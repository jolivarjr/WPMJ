<?php

/* Plugin Name: JotaGallery
 * Description: Plugin para galeria de imagens responsivo.
 * Version: 1.0
 * Author: Jolivar Machado
 * Author URI: https://github.com/jolivarjr
 * Text Domain: jotagallery 
 * 
 * Para listar todas as galerias basta criar uma página e utlizar o shortcode [jotagallery_photos]
 */

if (!function_exists('add_action')) {
    echo __("Eu sou só um plugin, não posso ser chamado diretamente", "jotagallery");
    exit;
}

// SETUP
define('JGALLERY_URL', __FILE__);
define('JGALLERY_BASE_URL', plugin_dir_url(__FILE__));

// INCLUDES
include('inc/ativar.php');
include('inc/init.php');
include('inc/admin/admin_init.php');
include('inc/filter-content.php');
include('inc/shortcodes/jg-photos.php');
include('inc/enqueue.php');

// HOOKS
register_activation_hook(JGALLERY_URL, 'jg_ativar_plugin');
add_action('init', 'jg_jotagallery_init');
add_action('admin_init', 'jg_jotagallery_admin_init');
add_action('save_post_jotagallery', 'jg_save_post_admin', 10, 3);
add_filter('the_content', 'jg_filter_jgallery_content');
add_action('wp_enqueue_scripts', 'jg_enqueue_scripts', 100);

// SHORTCODES
add_shortcode('jotagallery_photos', 'jg_load_gallery');
