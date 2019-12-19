<?php
include('meta_box_jg_galleryoptions.php');
include('enqueue.php');
include('jg_save_gallery.php');
include('jg_delete_gallery.php');

function jg_jotagallery_admin_init()
{
    add_action('add_meta_boxes_jotagallery', 'jg_jotagallery_metaboxes');
    add_action('admin_enqueue_scripts', 'jg_admin_enqueue');
    add_action('delete_post', 'jg_gallery_clear_all');

    // Salva imagens no banco
    add_action('wp_ajax_jg_save_gallery', 'jg_save_gallery');
    add_action('wp_ajax_nopriv_jg_save_gallery', 'jg_save_gallery');

    // Deleta imagens no banco
    add_action('wp_ajax_jg_delete_gallery', 'jg_delete_gallery');
    add_action('wp_ajax_nopriv_jg_delete_gallery', 'jg_delete_gallery');
}

function jg_jotagallery_metaboxes()
{
    add_meta_box(
        'jg_galleryoptions',
        __('Opções da JGallery', 'jotagallery'),
        'jg_galleryoptions',
        'jotagallery',
        'normal',
        'high'
    );
}

function jg_save_post_admin($post_id, $post, $update)
{
    if (!$update) {
        return;
    }

    /** SALVA NO BANCO **/
    global $wpdb;
    $wpdb->update(
        $wpdb->prefix . 'jotagalleries',
        array(
            'publicada' => 1
        ),
        array('jotagallery_id' => $post_id)
    );
}

// Limpa banco de dados e arquivos nas pastas depois que post é excluído da lixeira
function jg_gallery_clear_all($post_id)
{

    if ('jotagallery' == get_post_type($post_id)) {
        global $wpdb;

        $photos = $wpdb->get_results("SELECT nome FROM " . $wpdb->prefix . "jotagalleries WHERE jotagallery_id = $post_id", ARRAY_A);

        $res = $wpdb->delete($wpdb->prefix . "jotagalleries", ['jotagallery_id' => $post_id]);

        foreach ($photos as $photo) {

            if ($res) {
                wp_delete_file(WP_CONTENT_DIR  . "/uploads/jgallery/" . $photo['nome']);
                wp_delete_file(WP_CONTENT_DIR  . "/uploads/jgallery/min/" . $photo['nome']);
            }
        }
    }
}
