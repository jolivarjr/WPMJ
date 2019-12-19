<?php

add_action('wp_dashboard_setup', 'mj_add_dashboard_widgets');

function mj_add_dashboard_widgets()
{
    wp_add_dashboard_widget('wp_dashboard_widget', 'Sobre o site', 'mj_theme_info');
}

// callback com html
function mj_theme_info()
{
    echo "<ul>
       <li><strong>Site desenvolvido por:</strong> Jolivar Jr.</li>
       <li><strong>Precisa de ajuda?</strong> Envie um e-mail para <i>jolivarjunior@gmail.com</i></a></li>
       <li><strong>Contato:</strong> <a href='mailto:jolivarjunior@gmail.com'>jolivarjunior@gmail.com</a></li>
     </ul>";
}
