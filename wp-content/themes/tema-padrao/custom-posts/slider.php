<?php

$register_slider = new MJRegisterCustomPostType('sliders', 'Slider', 'o', [
    'menu_icon' => 'dashicons-images-alt2',
    'supports' => ['title', 'thumbnail']
]);

$slider_metaboxs = new MJRegisterMetaBox('slideroptions', 'Opções do Slider', ['sliders']);

$slider_metaboxs->add_field_form('text', [
    'label' => 'Link',
    'atributos' => [
        'id' => 'link',
        'placeholder' => 'Digite uma url válida',
        'name' => 'link'
    ]
]);

$slider_metaboxs->add_field_form('checkbox', [
    'label' => 'Abrir em outra aba',
    'atributos' => [
        'id' => 'abrir_em_outra_aba',
        'name' => 'abrir_em_outra_aba'
    ]
]);
