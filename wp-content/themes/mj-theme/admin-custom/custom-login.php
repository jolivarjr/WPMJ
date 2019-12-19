<?php

add_action('login_enqueue_scripts', 'login_styles');
function login_styles()
{
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');

    // substitui com a img padrão 
    $logo_url = MJ_TEMPLATE_URL . '/assets/imgs/logo-login.png'; // para colocar a logo do site, remover esta linha

    $logo_login = (!empty($logo_url)) ? "background-image: url(" . $logo_url . ") !important;" : "display: none !important;"
    ?>

<style>
    body.login {
        background-color: #E0E0E0;
    }

    .login h1 a {
        <?= $logo_login ?>
        background-size: 320px !important;
        max-height: 130px !important;
        width: 100% !important;
    }

    .login form {
        border-radius: 7px !important;
        box-shadow: 0px 0px 10px -4px rgba(0, 0, 0, 0.8) !important;
    }

    .login #backtoblog a:hover,
    .login #nav a:hover,
    .login h1 a:hover {
        color: #383535 !important;
    }

    .wp-core-ui .button-group.button-large .button,
    .wp-core-ui .button.button-large {
        background: #383535 !important;
        border-color: #383535 #383535 #383535 !important;
        box-shadow: 0 1px 0 #383535 !important;
        text-decoration: none !important;
        text-shadow: 0 -1px 1px #383535, 1px 0 1px #383535, 0 1px 1px #383535, -1px 0 1px #383535 !important;
    }

    input[type=text],
    input[type=password] {
        border-radius: 4px;
        border: thin #aaa solid
    }

    input:focus {
        border-color: #383535 !important;
        box-shadow: 0px 0px 2px 0px rgba(0, 0, 0, 0.5) !important;
        outline: 1px solid transparent !important;
        background: #eee !important;
    }

    .login #login_error,
    .login .message,
    .login .success {
        border-left: 4px solid #383535 !important;
    }
</style>

<?php
}


/*URL NA LOGO NA TELA DE LOGIN*/
add_filter('login_headerurl', 'my_login_logo_url');
function my_login_logo_url()
{
    return SITE_URL;
}
