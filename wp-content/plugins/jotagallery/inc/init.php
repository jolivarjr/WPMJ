<?php

function jg_jotagallery_init()
{
    $labels = [
        'name' => 'JotaGalleries',
        'singular' => 'JGallery',
        'menu_name' => 'JotaGalleries',
        'name_admin_bar' => 'JGallery',
        'add_new' => 'Adicionar Nova',
        'add_new_item' => 'Adicionar Nova JGallery',
        'new_item' => 'Nova JGallery',
        'edit_item' => 'Editar JGallery',
        'view_item' => 'Ver JGallery',
        'all_items' => 'Todas as JGalleries',
        'search_items' => 'Procurar JGallery',
        'parent_item_colon' => 'JGalleries Filhas',
        'not_found' => 'Nenhuma JGallery Encontrada',
        'not_found_in_trash' => 'Nenhuma JGallery Encontrada na Lixeira'
    ];

    $args = [
        'labels' => $labels,
        'description' => 'Plugin para galerias de imagens responsivo',
        'public' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'rewrite' => ['slug' => 'jotagallery'],
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-images-alt', // dashicons-format-gallery
        'supports' => ['title', 'thumbnail']
    ];

    register_post_type('jotagallery', $args);
}
