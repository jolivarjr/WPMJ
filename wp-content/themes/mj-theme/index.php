<!-- IN: index.php -->

<?php get_template_part('includes/header-page'); ?>

<main class="container">
	<div class="row">
		<div class="col-sm-8">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : ?>
					<?php the_post(); ?>
					<a class="box-list-blog" href="<?= get_permalink() ?>">
						<?= get_the_post_thumbnail($post->ID, 'loop_blog_thumbnail') ?>
						<span class="description-post-list">
							<span class="title"><?= get_the_title() ?></span>
							<span class="description"><?= get_the_excerpt() ?></span>
						</span>
					</a>
					<br />
				<?php endwhile; ?>
				<div class="pagination mb-4">
					<?= paginate_links() ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<aside class="sidebar">
				<?php if (is_active_sidebar('blog-sidebar')) : ?>
					<?php dynamic_sidebar('blog-sidebar') ?>
				<?php endif; ?>
			</aside>
		</div>
	</div>
</main>

<?php get_template_part('includes/footer-page'); ?>