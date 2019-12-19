
/************************************/
/** POPUP DE CONFIRMAÇÃO NO EVENTO **/
/************************************/
let guest_cod = jQuery("#guest_codigo").val().trim()

// Adiciona botão para abrir popup de confirmação
// jQuery('body').append(`
//     <div id="guest_codigo">Confirme Sua Presença</div>    
// `)

// Botões de Aumentar Convidados
jQuery('#qtd_less').on('click', function () {
    let qtd_init = parseInt(jQuery('#qtd_pessoas').val().trim())
    if (qtd_init > 0) {
        let = qtd_p = qtd_init - 1;
        jQuery('#qtd_pessoas').val(qtd_p)
    }
})
jQuery('#qtd_plus').on('click', function () {
    let = qtd_p = parseInt(jQuery('#qtd_pessoas').val().trim()) + 1;
    jQuery('#qtd_pessoas').val(qtd_p)
})
//Ativar PopUp de Confirmação
jQuery('.mjguest_confirm').on('click', function (e) {
    jQuery('.mj_popup').fadeIn(400).css('display', 'flex')
})

jQuery('.mj_popup .close').on('click', function () {
    jQuery(this).parent().fadeOut(400);
    setCookie('close_guess_popup', '_clicou_', 1)
})

// Fecha Geral
jQuery('#IMPLEMENTAR').on('click', function (e) {
    if (e.target.className != 'img') jQuery(this).fadeOut(400)
})

/*********************AJAX**********************/

jQuery('#mj_send').on('click', function (e) {
    e.preventDefault()

    let nome_convidado = jQuery('input[name=nome_convidado]').val().trim().toUpperCase()
    let qtd_pessoas = jQuery('input[name=qtd_pessoas]').val().trim()

    let status = 'Sem Resposta';
    jQuery('input[name=ausente]').each(function () {
        if (jQuery(this).is(':checked')) { status = jQuery(this).val() }
    })

    if (nome_convidado != getCookie('guest_nome')) {
        guest_cod = 0;
    }

    if (nome_convidado == '') {
        alert('Preencha o campo: (Seu Nome)')
        return
    } else if (nome_convidado.length < 3) {
        alert('Nome inválido')
        return
    }

    if (qtd_pessoas == '' && status == 'Presente') {
        alert('Preencha o campo: (Quantas Pessoas Acompanharão Você)')
        return
    }

    let cod = (guest_cod == 0) ? (nome_convidado.substr(0, 3) + Math.floor(Math.random() * 999 + 99)).toUpperCase() : guest_cod

    const guests = [{
        ID: 0,
        nome: nome_convidado,
        qtd_pessoas: qtd_pessoas || "0",
        codigo: cod,
        status: status,
        byCode: 0
    }]

    jQuery.ajax({
        type: 'POST',
        url: mj_object.ajax_url,
        data: {
            action: 'mj_save_guests',
            guests: guests,
            gpguests_id: jQuery("#gp_id").val().trim()
        },
        dataType: 'json',
        async: true,
        success: function (result) {

            if (result.guests.length > 0 && status == 'Presente') {
                alert("DADOS ENVIADOS COM SUCESSO!")

                jQuery('.mj_popup').fadeOut(400)

                setCookie('close_guess_popup', '_clicou_', 180)
                setCookie('guest_codigo', result.guests[0].codigo, 365)
                setCookie('guest_nome', result.guests[0].nome, 365)
                setCookie('guest_acompanhantes', result.guests[0].qtd_pessoas, 365)
                setCookie('guest_status', result.guests[0].status, 365)

            } else if (result.guests.length > 0 && status == 'Ausente') {
                alert("Lamentamos que não poderá comparecer :/ \n\nCaso mude de ideia, basta enviar novamente Seu nome e a Quantidade de Acompanhantes. \n\nAgradecemos o contato!")

                jQuery('.mj_popup').fadeOut(400)

                setCookie('close_guess_popup', '_clicou_', 1)
                setCookie('guest_codigo', result.guests[0].codigo, 365)
                setCookie('guest_nome', result.guests[0].nome, 365)
                setCookie('guest_acompanhantes', result.guests[0].qtd_pessoas, 365)
                setCookie('guest_status', result.guests[0].status, 365)

            } else if (result.updEqual == 1) {
                alert("DADOS ENVIADOS COM SUCESSO!")
                jQuery('.mj_popup').fadeOut(400)
            } else {
                alert("ERRO AO ENVIAR, NOS ENVIE UMA MENSAGEM ATRÁVES DO CONTATO DO SITE")
            }
        }
    })

    // sem usar até então
    function clearForm() {
        jQuery('input[name=nome_convidado]').val("")
        jQuery('input[name=qtd_pessoas]').val("")
        jQuery('input[name=ausente]').prop("checked", false)
    }
})

/*************************************************************/
/** FUNCOES **/
/*************************************************************/

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}