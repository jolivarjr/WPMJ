<?php

function mj_get_title_page()
{
    $output = "";
    if (is_page() || is_single()) {
        $output .= get_the_title();
    } else if (is_category()) {
        $output .= single_cat_title();
    } else if (is_tag()) {
        $output .= single_tag_title();
    } else if (is_404()) {
        $output .= "Página não encontrada!";
    } else if (is_tax()) {
        $get_tax = get_query_var('taxonomy');
        $get_term_slug = get_query_var($get_tax);
        $get_taxonomy = get_term_by('slug', $get_term_slug, $get_tax);
        $output .= $get_taxonomy->name;
    } else if (is_archive()) {
        $output .= post_type_archive_title('', false);
    } else if (is_search()) {
        $output .= "Resultados encontrados para: <span class='text-danger'>" . sanitize_text_field(get_search_query())."</span>";
    }
    return $output;
}

function mj_get_bootstrap_menu($menu_name = 'header', $args = array(), $label_menu = 'Menu', $css_class = 'd-sm-none d-md-none d-lg-none')
{
    $array_options = array(
        'echo' => false,
        'theme_location'    => $menu_name,
        'depth'             => 2,
        'container'         => 'div',
        'container_class'   => 'collapse navbar-collapse',
        'container_id'      => 'bs-example-navbar-collapse-1',
        'menu_class'        => 'nav navbar-nav',
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
        'walker'            => new WP_Bootstrap_Navwalker(),
    );

    $array_options = array_merge($array_options, $args);

    $output = '<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">';
    $output .= '<div class="container">';
    $output .= '<!-- Brand and toggle get grouped for better mobile display -->';
    $output .= '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">';
    $output .= '<span class="navbar-toggler-icon"></span>';
    $output .= '</button>';
    $output .= '<a class="navbar-brand ' . $css_class . '" href="' . SITE_URL . '">' . $label_menu . '</a>';
    $output .= wp_nav_menu($array_options);
    $output .= '</div>';
    $output .= '</nav>';

    return $output;
}
