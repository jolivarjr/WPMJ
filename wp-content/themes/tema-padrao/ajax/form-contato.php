<?php

add_action('wp_ajax_enviar_formulario_contato', 'enviar_formulario_contato');
add_action('wp_ajax_nopriv_enviar_formulario_contato', 'enviar_formulario_contato');

function enviar_formulario_contato()
{

    if (!empty($_POST)) {

        $alert_warning = '<div class="col-12"><div class="alert alert-warning d-inline-block" role="alert"><strong>{{label}}</strong></div></div>';
        $msg_error = "";

        if ($_POST['nome'] == '') {
            $msg_error .= str_replace("{{label}}", "Preencha o campo nome", $alert_warning);
        }

        if ($_POST['email'] == '') {
            $msg_error .= str_replace("{{label}}", "Preencha o campo email corretamente", $alert_warning);
        }

        if ($_POST['assunto'] == '') {
            $msg_error .= str_replace("{{label}}", "Preencha um assunto", $alert_warning);
        }

        if ($_POST['mensagem'] == '') {
            $msg_error .= str_replace("{{label}}", "Preencha o campo de mensagem", $alert_warning);
        }

        // Exibe a mensagem de erro
        if ($msg_error != '') {
            echo $msg_error;
            exit;
        }
        //passou na validação
        else {
            $to = SITE_OPTIONS['email_contato_site'] ?? "contato@site.com.br";

            $body = "";
            $body .= "<p><strong>Nome: " . sanitize_text_field($_POST['nome']) . "</strong></p>";
            $body .= "<p><strong>E-mail: " . sanitize_text_field($_POST['assunto']) . "</strong></p>";
            $body .= "<p><strong>Telefone: " . sanitize_text_field($_POST['telefone']) . "</strong></p>";
            $body .= "<p><strong>Assunto: " . sanitize_text_field($_POST['email']) . "</strong></p>";
            $body .= "<p><strong>Mensagem: " . sanitize_text_field($_POST['mensagem']) . "</strong></p>";

            $headers = array(
                "From: {$_POST['nome']} <{$_POST['email']}>",
                "Content-Type: text/html;charset=UTF-8"
            );

            $res = wp_mail($to, $_POST['assunto'], $body, $headers);

            if ($res) {
                echo '<div class="col-12"><div class="alert alert-success" role="alert"><strong>E-mail enviado com sucesso</strong></div></div>';
            } else {
                echo '<div class="col-12"><div class="alert alert-danger" role="alert"><strong>Falha ao enviar o e-mail</strong></div></div>';
            }
        }
    }
    exit;
}
