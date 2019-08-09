<!-- IN: 404.php -->

<?php get_template_part('includes/header-page'); ?>

<main class="container">
	<div class="row">
		<div class="col-sm-8">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : ?>
					<?php the_post(); ?>
					
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<aside class="sidebar">
				<?php if (is_active_sidebar('category-sidebar')) : ?>
					<?php dynamic_sidebar('category-sidebar') ?>
				<?php endif; ?>
			</aside>
		</div>
	</div>
</main>

<?php get_template_part('includes/footer-page'); ?>