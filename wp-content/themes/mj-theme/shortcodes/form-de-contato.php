<?php

add_shortcode('mj_form_contato', 'mj_form_contato');

function mj_form_contato($post)
{
	$output = '';

	$output .= '<form action="'.get_permalink($post).'" method="POST" class="mb-4">';

		$output .= '<div class="form-group">';

			$output .= '<div class="row">';
				$output .= '<div class="col-sm-6">';
					$output .= '<label for="nome_contato"><strong>Nome:</strong></label>';
					$output .= '<input id="nome_contato" name="nome_contato" class="form-control" value="" placeholder="Digite seu nome" />';
				$output .= '</div>';

				$output .= '<div class="col-sm-6">';
					$output .= '<label for="email_contato"><strong>E-mail:</strong></label>';
					$output .= '<input id="email_contato" name="email_contato" class="form-control" value="" placeholder="Digite seu e-mail" />';
				$output .= '</div>';
			$output .= '</div>';
			
		$output .= '</div>';

		$output .= '<div class="form-group">';

			$output .= '<div class="row">';
				$output .= '<div class="col-sm-6">';
					$output .= '<label for="telefone_contato"><strong>Telefone:</strong></label>';
					$output .= '<input id="telefone_contato" name="telefone_contato" class="form-control" value="" placeholder="Digite seu telefone" />';
				$output .= '</div>';

				$output .= '<div class="col-sm-6">';
					$output .= '<label for="assunto_contato"><strong>Assunto:</strong></label>';
					$output .= '<input id="assunto_contato" name="assunto_contato" class="form-control" value="" placeholder="Digite o assunto" />';
				$output .= '</div>';
			$output .= '</div>';
			
		$output .= '</div>';

		$output .= '<div class="form-group">';

			$output .= '<div class="row">';

				$output .= '<div class="col-sm-12">';
					$output .= '<label for="mensagem_contato"><strong>Mensagem:</strong></label>';
					$output .= '<textarea rows="6" id="mensagem_contato" name="mensagem_contato" class="form-control" value="" placeholder="Digite sua mensagem"></textarea>';
				$output .= '</div>';

			$output .= '</div>';
			
		$output .= '</div>';

		$output .= '<div class="form-group">';

			$output .= '<div class="row">';

				$output .= '<div class="col-sm-12">';
					$output .= '<button id="enviar_form_contato" class="btn btn-lg btn-success">Enviar</button>';
				$output .= '</div>';

			$output .= '</div>';
			
		$output .= '</div>';

		$output .= '<div class="row" id="result_form_contato"></div>';
		
	$output .= '</form>';

	return $output;
}