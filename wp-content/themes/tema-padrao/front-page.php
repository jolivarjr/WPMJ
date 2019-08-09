<!-- TEMPLATE NAME: front-page.php -->

<?php get_header(); ?>
<?php get_template_part('includes/sliders') ?>
<?php
if (have_posts()) {
	while (have_posts()) {
		the_post();
		echo '<a href="' . get_permalink() . '">';
		echo get_the_post_thumbnail($post->ID, 'thumbnail', array(
			'title' => '',
			'alt' => '',
			'class' => 'teste-de-class'
		));
		echo get_the_title();
		echo '</a>';
		echo '<hr />';
	}
} else {
	echo 'nenhum post no momento';
}
?>
<?php get_footer(); ?>