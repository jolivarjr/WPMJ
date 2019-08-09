<!-- TEMPLATE NAME: single.php -->

<?php get_template_part('includes/header-page'); ?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : ?>
		<?php the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
<?php endif; ?>
<?php get_template_part('includes/footer-page'); ?>