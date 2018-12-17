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
    */