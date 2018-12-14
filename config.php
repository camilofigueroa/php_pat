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