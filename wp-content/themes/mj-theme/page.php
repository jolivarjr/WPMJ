<!-- IN: page.php -->

<?php get_template_part('includes/header-page'); ?>
<main class="container content-page">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : ?>
			<?php the_post(); ?>
			<?php if (get_the_post_thumbnail($post, 'full')) : ?>
				<div class="destaque-thumbnail-pages"><?= get_the_post_thumbnail($post, 'full') ?></div>
			<?php endif; ?>
			<div class="description-pages">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</main>
<?php get_template_part('includes/footer-page'); ?>