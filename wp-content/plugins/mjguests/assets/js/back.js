jQuery(function () {

    jQuery("#add_guest").on('click', function (e) {
        e.preventDefault()

        jQuery('.form').append(`
        <div class="guest" id="0">
            <input type="text" name="nome" placeholder="Nome">
            <input type="text" name="qtd_pessoas" placeholder="Qtd. Pessoas">
            <input type="text" name="codigo" readonly placeholder="Código">
            <input type="text" name="status" placeholder="Status">
            <input type="text" name="data" placeholder="Data..." readonly>
            <button class="clearField">X</button>
        </div>
        `)

        delGuest()
    });

    delGuest()

    jQuery("#save_guests").on('click', function (e) {
        e.preventDefault()
        let checkName = true;

        jQuery(this).hide()
        jQuery('.loader').show()

        const guests = []
        let gpguests_id = jQuery("#gpguests_id").val().trim()

        jQuery(".guest").each(function (i, v) {
            let guest = jQuery(this);
            let objCodigo = guest.find('input[name=codigo]');
            let objStatus = guest.find('input[name=status]');

            let guest_id = guest.attr('id').trim()
            let nome = guest.find('input[name=nome]').val().trim().toUpperCase()
            let qtd_pessoas = guest.find('input[name=qtd_pessoas]').val().trim()  || "0"
            let codigo = codeGenerate(objCodigo.val().trim(), nome, objCodigo)
            let status = statusGenerate(objStatus.val().trim(), nome, objStatus)

            guests.push({
                ID: guest_id,
                nome: nome,
                qtd_pessoas: qtd_pessoas,
                codigo: codigo,
                status: status
            })
            checkName = (nome == '') ? false : checkName;
        })

        if (checkName) {
            jQuery.ajax({
                type: 'POST',
                url: mj_object.ajax_url,
                data: { action: 'mj_save_guests', guests: guests, gpguests_id: gpguests_id },
                dataType: 'json',
                async: true,
                success: function (result) {

                    jQuery.each(result['guests'], function (ri, rv) {
                        jQuery(".guest").each(function (i, v) {
                            let guest = jQuery(this);
                            let code = guest.find('input[name=codigo]').val().trim();

                            if (code == rv.codigo) {
                                guest.attr('id', rv.ID)
                                guest.find('input[name=data]').val(rv.data)
                                guest.find('input[name=qtd_pessoas]').val(rv.qtd_pessoas)
                            }
                        })
                    })

                    alert("Dados Salvos!")
                    jQuery('#save_guests').show()
                    jQuery('.loader').hide()
                },
                error: function (e) {
                    console.log(e)
                }
            })
        } else {
            jQuery('#save_guests').show()
            jQuery('.loader').hide()

            alert("Existem nomes vazios!")
        }
    })

})

/**************[FUNÇÕES PARA TRATAR DADOS]*****************/
function codeGenerate(cod, nomeGuest, obj) {
    if (cod == '' && nomeGuest != '') {
        cod = (nomeGuest.substr(0, 3) + Math.floor(Math.random() * 999 + 99)).toUpperCase()
    }
    obj.attr('value', cod)
    return cod
}

function statusGenerate(status, nomeGuest, obj) {
    if (status == '' && nomeGuest != '') {
        status = "Sem Resposta"
    }

    obj.attr('value', status)
    return status
}

function delGuest() {
    jQuery(".clearField").on('click', function (e) {
        e.preventDefault()
        const guest = jQuery(this).parent();

        let guestId = jQuery(this).parent().attr('id')

        if (guestId == 0) {
            guest.remove()
            return
        }

        if (guestId != '') {

            jQuery.ajax({
                type: 'POST',
                url: mj_object.ajax_url,
                data: { action: 'mj_del_guests', ID: guestId },
                dataType: 'text',
                async: true,
                success: function (result) {
                    console.log(result);

                    if (result != 0) guest.remove()
                }
            })
        } else {
            guest.remove()
        }
    });
}