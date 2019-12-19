<?php

/**
 * Register Custom Taxonomy
 */

class MJRegisterCustomTaxonomy
{
    private $type_name = '';
    private $singular_name = '';
    private $vinculo = array();
    private $gen = 'a';
    private $args = array();
    private $labels = array();

    function __construct($type_name, $singular_name, $vinculo = array(), $gen = 'a', $args = array(), $labels = array())
    {
        $this->type_name = $type_name;
        $this->singular_name = $singular_name;
        $this->vinculo = $vinculo;
        $this->gen = $gen ?? 'a';
        $this->args = $args;
        $this->labels = $labels;

        //registrando o action do custom post-type
        add_action('init', array($this, 'register_taxonomy'));
    }

    function register_taxonomy()
    {
        $space_gen = ($this->gen == 'o') ? '' : 'a';
        $labels = array(
            'name' => $this->singular_name,
            'singular_name' => $this->singular_name,
            'menu_name' => $this->singular_name,
            'all_items' => 'Tod' . $this->gen . 's ' . $this->gen . 's ' . strtolower($this->singular_name) . 's',
            'parent_item' => $this->singular_name . ' Pai',
            'new_item_name' => 'Novo nome de ' . strtolower($this->singular_name),
            'add_new_item' => 'Adicionar um' . $space_gen . ' nov' . $this->gen . ' ' . strtolower($this->singular_name),
            'edit_item' => 'Editar ' . strtolower($this->singular_name),
            'update_item' => 'Atualizar ' . strtolower($this->singular_name),
            'view_item' => 'Visualizar ' . strtolower($this->singular_name),
            'add_or_remove_items' => 'Adicionar ou remover ' . strtolower($this->singular_name) . 's',
            'separate_items_with_commas' => 'Separar por virgulas',
            'choose_from_most_used' => 'Escolher entre ' . $this->gen . 's mais utilizadas',
            'popular_items' => '' . strtolower($this->singular_name) . 's mais populares',
            'search_items' => 'Pesquisar ' . strtolower($this->singular_name) . 's',
            'not_found' => 'Nada foi encontrado',
            'no_terms' => 'Nenhum' . $space_gen . ' ' . strtolower($this->singular_name),
            'items_list' => 'Lista de ' . strtolower($this->singular_name) . 's',
            'items_list_navigation' => 'Lista de navegação para ' . strtolower($this->singular_name) . 's'
        );

        $labels = array_merge($labels, $this->labels);

        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => false,
        );

        $args = array_merge($args, $this->args);

        $vinculo = is_array($this->vinculo) ? $this->vinculo : array($this->vinculo);
        register_taxonomy($this->type_name, $vinculo, $args);
    }
}

//exemplo de como utilizar
//new MJRegisterCustomTaxonomy('generos', 'Gênero', 'filmes');
