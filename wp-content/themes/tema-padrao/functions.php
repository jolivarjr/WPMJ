<?php
require_once 'core/index.php';

function mj_settings_theme()
{
	add_theme_support('custom-logo');
	add_theme_support('post-thumbnails');
	//exemplo de como criar tamanhos personalizados de imagens
	//add_image_size( 'primeiroteste', '350', '50', true );

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
