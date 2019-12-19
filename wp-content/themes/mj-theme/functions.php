<?php

// setup do tema
add_action('after_setup_theme', 'mj_settings_theme');
function mj_settings_theme()
{
	add_theme_support('custom-logo');
	add_theme_support('post-thumbnails');

	// tamanhos personalizados de imagens
	add_image_size('loop_blog_thumbnail', '350', '280', true);

	// registrando menus
	register_nav_menu('header', 'Header');
	register_nav_menu('footer', 'Footer');
}

// funções genericas para agilizar o desenvolvimento
require_once 'core/index.php';

// aqui são carregadas as funções que recebem dados enviados via ajax
require_once 'ajax/index.php';

// funções para personalizar a parte administrativa do wordpress
require_once 'admin-custom/index.php';

// carrega os custom posts types
require_once 'custom-posts/index.php';

// carrega as funções de shortcodes 
require_once 'shortcodes/index.php';

// Campos de configurações gerais do tema
if (is_admin()) {
	$mj_theme_options = new MJConfigThemeOptions();

	$mj_theme_options->add_custom_field('input', 'E-mail de Contato', [
		'atributos' => [
			'name' => 'email_contato_site'
		]
	]);
	$mj_theme_options->add_custom_field('input', 'Telefone', [
		'atributos' => [
			'name' => 'telefone_site'
		]
	]);
	$mj_theme_options->add_custom_field('input', 'Facebook', [
		'atributos' => [
			'name' => 'facebook_site'
		]
	]);
	$mj_theme_options->add_custom_field('input', 'Instagram', [
		'atributos' => [
			'name' => 'instagram_site'
		]
	]);
	$mj_theme_options->add_custom_field('input', 'Twitter', [
		'atributos' => [
			'name' => 'twitter_site'
		]
	]);
}

/**
 * Abaixo Código padrão do tema e customizações
 */

// registrando sidebars
add_action('widgets_init', 'mj_register_my_widgets_theme');
function mj_register_my_widgets_theme()
{
	// 1 coluna rodapé 
	register_sidebar(array(
		'name' => 'Primeira Coluna Rodapé',
		'id' => 'footer-primeira-coluna',
		'description' => 'Primeira coluna do rodapé do site'
	));
	// 2 coluna rodapé 
	register_sidebar(array(
		'name' => 'Segunda Coluna Rodapé',
		'id' => 'footer-segunda-coluna',
		'description' => 'Segunda coluna do rodapé do site'
	));
	// 3 coluna rodapé 
	register_sidebar(array(
		'name' => 'Terceira Coluna Rodapé',
		'id' => 'footer-terceira-coluna',
		'description' => 'Terceira coluna do rodapé do site'
	));

	// coluna sidebar para blog do site
	register_sidebar(array(
		'name' => 'Barra Lateral do Blog',
		'id' => 'blog-sidebar',
		'description' => 'Barra Lateral do Blog'
	));
}
