<!-- IN: front-page.php -->

<?php get_header(); ?>
<?php get_template_part('includes/sliders') ?>
<main class="container content-page">
	<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			the_content();

			?>

			<?php
		}
	} else {
		echo 'Página em construção!';
	}
	?>
</main>
<?php get_template_part('includes/footer-page'); ?>