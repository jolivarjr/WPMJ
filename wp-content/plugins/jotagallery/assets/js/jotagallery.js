jQuery(function () {

    // Salva fotos no banco
    jQuery("#btSendJg").on('click', function (e) {
        e.preventDefault()

        jQuery('.loader').show()

        let formdata = new FormData();
        formdata.append('action', 'jg_save_gallery')
        formdata.append('gallery_id', jQuery("#gallery_id").val())

        let imgs = jQuery('#imgsJgallery')[0].files

        if (imgs.length > 0) {

            jQuery.each(imgs, function (i, foto) {
                formdata.append(`foto_${i}`, foto);
            })

            jQuery.ajax({
                type: 'post',
                url: jotagallery_obj.ajax_url,
                data: formdata,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (result) {

                    jQuery.each(result, function (i, v) {
                        jQuery("#resultJg").append(`
                            <div class='img'>                        
                                <span class="deleteJg">X</span>
                                <img id='${v.img_id}' src='${v.src}'>
                            </div>
                        `)
                    })

                    jQuery('.loader').fadeOut()
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }
    })

    // Deletar as Fotos Individualmente
    jQuery(".deleteJg").on('click', function (e) {
        e.preventDefault()
        const imgPai = jQuery(this).parents('.img');

        let img_id = jQuery(this).siblings('img').attr('id')

        jQuery.ajax({
            type: 'post',
            url: jotagallery_obj.ajax_url,
            data: { action: 'jg_delete_gallery', img_id: img_id },
            dataType: 'text',
            success: function (res) {
                if (res) imgPai.remove()
            }
        })
    })
})