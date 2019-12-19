<?php

$register_slider = new MJRegisterCustomPostType('links', 'Link', 'o', [
    'menu_icon' => 'dashicons-admin-links',
    'supports' => ['title', 'thumbnail']
]);

$slider_metaboxs = new MJRegisterMetaBox('link', 'Link', ['links']);

$slider_metaboxs->add_field_form('text', [
    'label' => 'Url do Link:',
    'atributos' => [
        'id' => 'url',
        'placeholder' => 'Digite uma url válida',
        'name' => 'url'
    ]
]);

$slider_metaboxs->add_field_form('checkbox', [
    'label' => 'Abrir em outra aba',
    'atributos' => [
        'id' => 'abrir_em_outra_aba',
        'name' => 'abrir_em_outra_aba'
    ]
]);
