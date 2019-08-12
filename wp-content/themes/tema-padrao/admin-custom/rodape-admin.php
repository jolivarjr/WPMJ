<?php

add_filter('admin_footer_text', 'change_footer_admin');

function change_footer_admin()
{
    echo 'Website criado por Jolivar Jr. utilizando WordPress como CMS. Se precisar de ajuda,  Envie um e-mail para <i>jolivarjunior@gmail.com</i>. Estamos à disposição ;-)';
}