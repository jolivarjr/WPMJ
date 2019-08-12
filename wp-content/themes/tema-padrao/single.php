<!-- IN: single.php -->

<?php get_template_part('includes/header-page'); ?>

<main id="single-blog" class="container">
	<div class="row">
		<div class="col-sm-8">
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : ?>
			<?php the_post(); ?>

			<?php $thumbnail = get_the_post_thumbnail($post, 'full', ['title' => get_the_title(), 'alt' => get_the_title(), 'class' => 'img_single_post']); ?>

			<!-- Verificando se existe uma imagem destacada -->
			<?php if ($thumbnail) : ?>
			<?= $thumbnail ?>
			<?php endif; ?>

			<?php the_title('<h1 class="single-title">', '</h1>') ?>

			<?php the_content(); ?>

			<?php endwhile; ?>
			<?php endif; ?>

			<!-- POSTS RELACIONADOS -->
			<?php query_posts(array('posts_per_page' => 4, 'orderby' => 'rand')); ?>
			<?php if (have_posts()) : ?>
			<hr>
			<div class="posts-relacionados">
				<h2>Posts Relacionados</h2>
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
			</div>
			<?php endif; ?>
			<?php wp_reset_query(); ?>
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