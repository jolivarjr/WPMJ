<?php

//contasntes
define('MJ_TEMPLATE_URL', get_template_directory_uri());
define('SITE_URL', get_site_url());
define('AJAX_URL', admin_url('admin-ajax.php'));
define('SITE_OPTIONS', get_option('mj_option_theme'));

// carrega os plugins
require 'plugins/wp-bootstrap-navwalker.php';

//carrega os css do tema
require 'load-css.php';

//carrega os JS do tema
require 'load-js.php';

//general functions (classes)
require 'functions-general.php';

//actions
require 'functions-actions.php';

//filters
require 'functions-filters.php';

//renderizador de formulários 
require 'form-render.php';

//register custom post type
require 'register-custom-post-type.php';

//register custom taxonomy
require 'register-custom-taxonomy.php';

// register meta box
require 'register-custom-metabox.php';

// register theme options
require 'theme-options.php';

// Função para testes
function pre($arg)
{
    echo "<pre>";
    print_r($arg);
    echo "</pre>";
}
