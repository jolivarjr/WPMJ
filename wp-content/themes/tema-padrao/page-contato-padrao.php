<!-- IN: page-contato-padrao.php -->

<?php
/**
 * Template Name: Página de Contato Padrão
 */
?>

<?php get_template_part('includes/header-page'); ?>

<main class="container content-page">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : ?>
			<?php the_post(); ?>
			<?php the_content() ?>
			<?= do_shortcode('[mj_form_contato]'); ?>
		<?php endwhile; ?>
	<?php endif; ?>
</main>

<?php get_template_part('includes/footer-page'); ?>