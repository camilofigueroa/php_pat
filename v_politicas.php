<?php

    /**
     * Autor: Camilo Figueroa ( Crivera )
     *
     *
     */

    include( "clases/Operaciones.php" );

    $obj_operaciones = new Operaciones();
    
    if( !isset( $_SESSION ) ) session_start();
    $_SESSION[ 'en_sesion' ] = 0;
    $_SESSION[ 'nivel' ] = -1;
    $_SESSION[ 'ruta' ] = "";
        
?>

<!doctype html>
<html lang="en">
    
    <head>
        
        <?php include( "analytics.php" ); ?>
        
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/estilos.css"> 
        
        <title><?= $obj_operaciones->retornar_titulo_app() ?></title>       
        
    </head>
    
    <body>
        
        <br>
        
        <div class="container">
            
            <div class="contenedor-general-objetos">
                
                <a href="v_autenticacion.php">Home - Inicio.</a>
                
                <br>
                <br>
               
                <p>En este sitio se usan cookies para mejorar la experiencia de usuario, para limitar el acceso de aquellos no autorizados protegiendo la exclusividad de los inversionistas, y para llevar estadísticas de los archivos o documentos según el interés de los navegantes. </p>
                <p>Si un usuario no desea que su computador guarde las cookies, este puede configurar su máquina para denegarle al servidor esta particularidad cada vez que se solicite la instalación de uno de estos archivos. </p>
                <p>También se pueden borrar estos archivos mediante las siguientes opciones para algunos de los navegadores del mercado.</p>
                <p>Firefox: <i>Herramientas -> Opciones -> Privacidad -> Historial -> Configuración Personalizada.</i> Para más información, puede consultar el soporte de Mozilla o la Ayuda del navegador.</p>
                <p>Chrome: <i>Configuración -> Mostrar opciones avanzadas -> Privacidad -> Configuración de contenido.</i> Para más información, puede consultar el soporte de Google o la Ayuda del navegador.</p>
                <p>Internet Explorer: <i>Herramientas -> Opciones de Internet -> Privacidad -> Configuración.</i> Para más información, puede consultar el soporte de Microsoft o la Ayuda del navegador.</p>
                <p>Safari: <i>Preferencias -> Seguridad.</i> Para más información, puede consultar el soporte de Apple o la Ayuda del navegador.</p>
                <p><strong>SESSION:</strong> esta cookie es propia del sitio y sirve para mantener la sesión de aquellos que están autorizados y para mantener fuera los que no lo están.</p>
                <p><strong>_ga:</strong> esta cookie es de Google Analytics o analíticas de Google. <a href="https://developers.google.com/analytics/devguides/collection/gajs/cookie-usage" target="_blank" rel="nofollow">Más.</a></p>
                <p><strong>_gid:</strong> esta cookie es de Google Analytics o analíticas de Google. <a href="https://developers.google.com/analytics/devguides/collection/gajs/cookie-usage" target="_blank" rel="nofollow">Más.</a></p>
                <p>Con respecto de las cookies de terceros, este sitio no se hace responsable del contenido y veracidad de sus políticas de privacidad o del uso que ellos puedan darle a la información sobre los usuarios y su comportamiento, almacenados en sus bases de datos o cualquier otra arquitectura o medio de almacenamiento.</p>

            </div>
               
        </div> <!-- container -->
                        
        <hr>
                        
        <br><br><br><br><br>
                                        
        <footer class="footer">
            <p><?= $obj_operaciones->traer_texto_footer() ?></p>
        </footer>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
    </body>
    
</html>