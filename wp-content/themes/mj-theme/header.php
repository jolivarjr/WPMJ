<?php
$custom_logo_id = get_theme_mod('custom_logo');
$logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
$logo = (!empty($logo_url)) ? "<img src='" . $logo_url . "' width='120' />" : ""
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php wp_title('|', true, 'right'); ?></title>
	<?php wp_head(); ?>

	<script>
		window.MJ_AJAX_URL = "<?= AJAX_URL ?>"
	</script>
</head>

<body>
	<header id="header-top-site" class="bg-principal">
		<div class="container">
			<?php
			the_custom_logo();
			?>
		</div>

		<?= mj_get_bootstrap_menu(null, [], $logo) ?>
	</header>
	<hr />