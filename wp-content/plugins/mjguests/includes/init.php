<?php

function mj_guests_init()
{
    $labels = [
        'name' => 'MJ Guests',
        'singular' => 'MJ Guests',
        'menu_name' => 'MJ Guests',
        'name_admin_bar' => 'MJ Guests',
        'add_new' => 'Adicionar Novo Grupo de Convidados',
        'add_new_item' => 'Adicionar Novo Grupo',
        'new_item' => 'Novo Grupo',
        'edit_item' => 'Editar Grupo',
        'view_item' => 'Ver Grupo',
        'all_items' => 'Todas os Grupos',
        'search_items' => 'Procurar Grupo',
        'parent_item_colon' => 'MJ Guests Filhos',
        'not_found' => 'Nenhum Grupo Encontrado',
        'not_found_in_trash' => 'Nenhumo Grupo Encontrada na Lixeira'
    ];

    $args = [
        'labels' => $labels,
        'description' => 'Plugin para lista de convidados',
        'public' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'rewrite' => ['slug' => 'mjguests'],
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-groups',
        'supports' => ['title']
    ];

    register_post_type('mjguests', $args);
}
