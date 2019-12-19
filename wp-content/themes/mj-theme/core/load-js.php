<?php
function mj_load_js()
{
	wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), 1, true);
	wp_enqueue_script('bootstrap', MJ_TEMPLATE_URL . '/assets/js/bootstrap.min.js', array('jquery'), 1, true);
	wp_enqueue_script('owl-carousel', MJ_TEMPLATE_URL . '/assets/js/owl.carousel.min.js', array('jquery'), 1, true);
	wp_enqueue_script('common_theme', MJ_TEMPLATE_URL . '/assets/js/common.js', array('jquery'), 2, true);
}
add_action('wp_enqueue_scripts', 'mj_load_js');
