<!-- IN: page-contato.php -->

<?php
/**
 * Template Name: Página de Contato
 */
?>

<?php get_template_part('includes/header-page'); ?>
<main class="container content-page">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : ?>
			<?php the_post(); ?>
			<form action="<?= get_permalink($post) ?>" method="POST" class="mb-4">

				<div class="form-group">
					<label class="text-dark font-weight-bold" for="nome">Nome:</label>
					<input type="text" class="form-control" name="nome_contato" id="nome_contato" placeholder="Digite seu nome...">
				</div>

				<div class="form-group">
					<label class="text-dark font-weight-bold" for="assunto">Assunto:</label>
					<input type="text" class="form-control" name="assunto_contato" id="assunto_contato" placeholder="Digite o assunto...">
				</div>

				<div class="form-group">
					<label class="text-dark font-weight-bold" for="email">E-mail:</label>
					<input type="email" class="form-control" name="email_contato" id="email_contato" placeholder="Digite seu e-mail...">
				</div>

				<div class="form-group">
					<label class="text-dark font-weight-bold" for="mensagem">Mensagem:</label>
					<textarea class="form-control" name="mensagem_contato" id="mensagem_contato" placeholder="Digite sua mensagem..." rows="5"></textarea>
				</div>

				<button type="submit" id="enviar_form_contato" class="btn btn-dark border-0 w-100">Enviar</button>
			</form>

			<div class="row" id="result_form_contato"></div>
			
		<?php endwhile; ?>
	<?php endif; ?>
</main>
<?php get_template_part('includes/footer-page'); ?>