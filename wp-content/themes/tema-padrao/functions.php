<?php
require_once 'core/index.php';
require_once 'ajax/index.php';

function mj_settings_theme()
{
	add_theme_support('custom-logo');
	add_theme_support('post-thumbnails');

	//exemplo de como criar tamanhos personalizados de imagens
	add_image_size('loop_blog_thumbnail', '350', '280', true);

	register_nav_menu('header', 'Header');
	register_nav_menu('footer', 'Footer');
}
add_action('after_setup_theme', 'mj_settings_theme');

/**********************SLIDER***********************/
$register_slider = new MJRegisterCustomPostType('sliders', 'Slider', null, [
	'menu_icon' => 'dashicons-images-alt2',
	'supports' => ['title', 'thumbnail']
]);
$slider_metaboxs = new MJRegisterMetaBox('slideroptions', 'Opções do Slider', ['sliders']);

$slider_metaboxs->add_field_form('text', [
	'label' => 'Link',
	'atributos' => [
		'id' => 'link',
		'placeholder' => 'Digite uma url válida',
		'name' => 'link'
	]
]);
$slider_metaboxs->add_field_form('checkbox', [
	'label' => 'Abrir em outra aba',
	'atributos' => [
		'id' => 'abrir_em_outra_aba',
		'name' => 'abrir_em_outra_aba'
	]
]);

/**
 * Custom Theme Options
 */

if (is_admin()) {
	$mj_theme_options = new MJConfigThemeOptions();

	$mj_theme_options->add_custom_field('input', 'E-mail de Contato', [
		'atributos' => [
			'name' => 'email_contato_site'
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
	$mj_theme_options->add_custom_field('input', 'Telefone', [
		'atributos' => [
			'name' => 'telefone_site'
		]
	]);
}

/**
 * Aqui você deve colocar o código padrão do seu tema
 * Assim como suas customizações
 */
function mj_register_my_widgets_theme()
{
	// Registrando as colunas do rodapé 
	register_sidebar(array(
		'name' => 'Primeira Coluna Rodapé',
		'id' => 'footer-primeira-coluna',
		'description' => 'Primeira coluna do rodapé do site'
	));

	register_sidebar(array(
		'name' => 'Segunda Coluna Rodapé',
		'id' => 'footer-segunda-coluna',
		'description' => 'Segunda coluna do rodapé do site'
	));

	register_sidebar(array(
		'name' => 'Terceira Coluna Rodapé',
		'id' => 'footer-terceira-coluna',
		'description' => 'Terceira coluna do rodapé do site'
	));

	// Registrando a sidebar da categoria
	register_sidebar(array(
		'name' => 'Sidebar da Categoria',
		'id' => 'category-sidebar',
		'description' => 'Sidebar da Categoria do site'
	));
}
add_action('widgets_init', 'mj_register_my_widgets_theme');
