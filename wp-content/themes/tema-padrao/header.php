<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php wp_title('|', true, 'right'); ?></title>
	<?php wp_head(); ?>
</head>

<body>
	<div class="container">
		<?php
		the_custom_logo();

		// $custom_logo_id = get_theme_mod('custom_logo');
		// $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
		// echo '<img src="' . $logo_url . '">';
		?>
	</div>

	<?= mj_get_bootstrap_menu() ?>
	<hr />