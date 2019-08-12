<?php

add_action('init', 'modificar_post_object');

function modificar_post_object()
{
    $singular_name = 'Noticia';
    $genero = 'a';
    $space_gen = ($genero == 'o') ? '' : 'a';

    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = $singular_name . 's';
    $labels->singular_name = $singular_name . '';
    $labels->add_new = 'Adicionar nov' . $genero;
    $labels->add_new_item = 'Adicionar nov' . $genero . ' ' . strtolower($singular_name) . '';
    $labels->edit_item = 'Editar ' . strtolower($singular_name) . '';
    $labels->new_item = 'Nov' . $genero . ' ' . strtolower($singular_name) . '';
    $labels->view_item = 'Visualizar ' . strtolower($singular_name) . '';
    $labels->search_items = 'Pesquisar ' . strtolower($singular_name) . 's';
    $labels->not_found = 'Nenhum' . $space_gen . ' ' . strtolower($singular_name) . ' foi encontrado';
    $labels->not_found_in_trash = 'Nenhum' . $genero . ' ' . strtolower($singular_name) . ' encontrado na lixeira';
    $labels->all_items = 'Tod' . $genero . 's ' . $genero . 's ' . strtolower($singular_name) . 's';
    $labels->menu_name = $singular_name . 's';
    $labels->name_admin_bar = $singular_name;
}