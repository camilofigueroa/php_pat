<?php

    $titulo_aplicacion = "Patrocinico.";

    $servidor   = "localhost";
    $usuario    = "root";
    $clave      = "camilof1234";
    $bd         = "bd_php_pat";
    
    //$ruta_general = "videos"; //Si la carpeta de contenido está afuera o no de este sitio, el programa elegirá ciertas opciones.
    $ruta_general = "../otro-sitio/videos";
    
    //Esta clave para encriptación es obsoleta al 13/12/2018.
    $clave_encriptacion = "fiesta decembrin"; //Aquí hay que cuadrar la clave según lo que informe la clase AES.
    
    //Se implementa esta nueva forma de encriptar al 13/12/2018.
    $secret_key = 'Nueva opción de llave.';
    $secret_iv = 'Otra opcion de llave';
    
    //Configurar aquí los tipos de archivo que no se quieran mostrar.
    $lista_archivos_no_mostrar = array( ".php", ".html", ".exe", ".htm", ".xml", ".xls", ".xlsx" );
    
    //Texto del footer
    $texto_footer = "Prueba de sitio patrocinio. <br>";
    $texto_footer .= "<table id='tabla-footer'><tr>";
    $texto_footer .= "<td><a href='http://www.google.com' target='_blank' class='text-warning'>Enlace</a></td>";
    $texto_footer .= "<td><a href='http://www.google.com' target='_blank' class='text-warning'>Enlace</a></td>";
    $texto_footer .= "<td><a href='http://www.google.com' target='_blank' class='text-warning'>Enlace</a></td>";
    $texto_footer .= "</tr></table>";
    $texto_footer .= "<td><a href='v_politicas.php' target='_self' class='text-warning'>Uso de cookies</a></td>";
    
    
    /*    
        Colores de enlaces del bootstrap
        
        <p><a href="#" class="text-primary">Primary link</a></p>
        <p><a href="#" class="text-secondary">Secondary link</a></p>
        <p><a href="#" class="text-success">Success link</a></p>
        <p><a href="#" class="text-danger">Danger link</a></p>
        <p><a href="#" class="text-warning">Warning link</a></p>
        <p><a href="#" class="text-info">Info link</a></p>
        <p><a href="#" class="text-light bg-dark">Light link</a></p>
        <p><a href="#" class="text-dark">Dark link</a></p>
        <p><a href="#" class="text-muted">Muted link</a></p>
        <p><a href="#" class="text-white bg-dark">White link</a></p>
        
        <div class="p-3 mb-2 bg-primary text-white">.bg-primary</div>
        <div class="p-3 mb-2 bg-secondary text-white">.bg-secondary</div>
        <div class="p-3 mb-2 bg-success text-white">.bg-success</div>
        <div class="p-3 mb-2 bg-danger text-white">.bg-danger</div>
        <div class="p-3 mb-2 bg-warning text-dark">.bg-warning</div>
        <div class="p-3 mb-2 bg-info text-white">.bg-info</div>
        <div class="p-3 mb-2 bg-light text-dark">.bg-light</div>
        <div class="p-3 mb-2 bg-dark text-white">.bg-dark</div>
        <div class="p-3 mb-2 bg-white text-dark">.bg-white</div>
        
        <div class="p-3 mb-2 bg-gradient-primary text-white">.bg-gradient-primary</div>
        <div class="p-3 mb-2 bg-gradient-secondary text-white">.bg-gradient-secondary</div>
        <div class="p-3 mb-2 bg-gradient-success text-white">.bg-gradient-success</div>
        <div class="p-3 mb-2 bg-gradient-danger text-white">.bg-gradient-danger</div>
        <div class="p-3 mb-2 bg-gradient-warning text-dark">.bg-gradient-warning</div>
        <div class="p-3 mb-2 bg-gradient-info text-white">.bg-gradient-info</div>
        <div class="p-3 mb-2 bg-gradient-light text-dark">.bg-gradient-light</div>
        <div class="p-3 mb-2 bg-gradient-dark text-white">.bg-gradient-dark</div>
        
        <span class="badge badge-primary">Primary</span>
        <span class="badge badge-secondary">Secondary</span>
        <span class="badge badge-success">Success</span>
        <span class="badge badge-danger">Danger</span>
        <span class="badge badge-warning">Warning</span>
        <span class="badge badge-info">Info</span>
        <span class="badge badge-light">Light</span>
        <span class="badge badge-dark">Dark</span>
        
        <span class="badge badge-pill badge-primary">Primary</span>
        <span class="badge badge-pill badge-secondary">Secondary</span>
        <span class="badge badge-pill badge-success">Success</span>
        <span class="badge badge-pill badge-danger">Danger</span>
        <span class="badge badge-pill badge-warning">Warning</span>
        <span class="badge badge-pill badge-info">Info</span>
        <span class="badge badge-pill badge-light">Light</span>
        <span class="badge badge-pill badge-dark">Dark</span>
        
        <a href="#" class="badge badge-primary">Primary</a>
        <a href="#" class="badge badge-secondary">Secondary</a>
        <a href="#" class="badge badge-success">Success</a>
        <a href="#" class="badge badge-danger">Danger</a>
        <a href="#" class="badge badge-warning">Warning</a>
        <a href="#" class="badge badge-info">Info</a>
        <a href="#" class="badge badge-light">Light</a>
        <a href="#" class="badge badge-dark">Dark</a>
    */