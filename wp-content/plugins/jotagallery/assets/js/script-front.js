jQuery('body').prepend(`
<div class="jg_bgbox">
    <div class="jg_backbox">
        <img class="img" src="">
        <span class="jg_close">X</span>
    </div>
</div>
`)

function redimensionar(width, height) {

    let newWidth = 0, newHeight = 0, ratio = 0, dimensions = { nW: 0, nH: 0 }

    let nW = window.innerWidth - 80
    let nH = window.innerHeight - 80

    ratio = (100 * nH / height) / 100
    dimensions.nW = ratio * width
    dimensions.nH = ratio * height

    if (dimensions.nW > window.innerWidth) {
        ratio = (100 * nW / dimensions.nW) / 100
        dimensions.nW = ratio * dimensions.nW
        dimensions.nH = ratio * dimensions.nH
    }

    return dimensions
}

jQuery('.jg_gallery figure').click(function () {

    var img = new Image();
    img.src = jQuery(this).find('.thumby').data("src")

    setTimeout(function () {
        let widthImg = img.naturalWidth
        let heightImg = img.naturalHeight
        let dimensions = 0

        if (widthImg > window.innerWidth || heightImg > window.innerHeight) {
            dimensions = redimensionar(widthImg, heightImg)
        }

        jQuery('.jg_backbox img').attr('src', img.src)

        if (dimensions != 0) {
            jQuery('.jg_backbox').css('width', dimensions.nW).css('height', dimensions.nH)
        } else {
            jQuery('.jg_backbox').css('width', (widthImg)).css('height', (heightImg))
        }

        jQuery('.jg_bgbox').fadeIn(400).css('display', 'flex')

        jQuery('.jg_close').click(function () {
            jQuery(this).parents('.jg_bgbox').fadeOut(400)
        })
    }, 50)

})

jQuery('.jg_bgbox').on('click', function (e) {
    if (e.target.className != 'img') jQuery(this).fadeOut(400)
})