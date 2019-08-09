<!-- TEMPLATE NAME: category.php -->

<?php get_template_part('includes/header-page'); ?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : ?>
		<?php the_post(); ?>
		<a href="<?= get_permalink() ?>">
			<?= get_the_title() ?>
		</a>
		<br />
	<?php endwhile; ?>
	<?= paginate_links() ?>
<?php endif; ?>
<?php get_template_part('includes/footer-page'); ?>