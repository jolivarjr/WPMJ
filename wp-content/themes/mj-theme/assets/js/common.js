jQuery(document).ready(function () {
    jQuery('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
});

// Envia e-mail do formulário de contato
jQuery(document).ready(function () {

    jQuery("#enviar_form_contato").on('click', function (event) {
        event.preventDefault()

        let nome = jQuery("#nome_contato").val().trim()
        let email = jQuery("#email_contato").val().trim()
        let telefone = jQuery("#telefone_contato").val().trim()
        let assunto = jQuery("#assunto_contato").val().trim()
        let mensagem = jQuery("#mensagem_contato").val().trim()

        jQuery.ajax({
            url: window.MJ_AJAX_URL,
            type: 'POST',
            data: {
                action: 'enviar_formulario_contato',
                nome, email, telefone, assunto, mensagem
            },
            success: function (resultado) {
                jQuery("#result_form_contato").html(resultado)

                if (resultado.search("E-mail enviado com sucesso") > 0) {
                    jQuery("input,textarea").val("")

                    setTimeout(function () {
                        jQuery('.alert').hide(500)
                    }, 7000)
                }
            }
        })
    })
})