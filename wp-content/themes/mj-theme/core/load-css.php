<?php

// FRONT-END CSS
function mj_load_css()
{
	wp_enqueue_style('bootstrap-padrao', MJ_TEMPLATE_URL . '/assets/css/bootstrap.min.css', array());
	wp_enqueue_style('fontawesome', MJ_TEMPLATE_URL . '/assets/css/fontawesome.css', array());
	wp_enqueue_style('owlcss', MJ_TEMPLATE_URL . '/assets/css/owl.carousel.min.css', array());
	wp_enqueue_style('style_theme', MJ_TEMPLATE_URL . '/assets/css/style.css', array());
}
add_action('wp_enqueue_scripts', 'mj_load_css');

// BACK-END CSS
function mj_load_admin_css()
{
	wp_enqueue_style('mj_style_admin', MJ_TEMPLATE_URL . '/assets/css/style-admin.css', [], '1.0');
}
add_action('admin_enqueue_scripts', 'mj_load_admin_css');
