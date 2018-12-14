<?php

    /**
     * Autor: Camilo Figueroa ( Crivera )
     *
     *
     *
     */
    
    include( "clases/Operaciones.php" );
    $obj_operaciones = new Operaciones();
 
    if( !isset( $_SESSION ) ) session_start();
    $en_sesion = 0;
    $nivel = -1;
    $destino = "";
    
    //Si existe la variable de sesión, puede no ser la primera vez que pasó por acá.
    if( isset( $_SESSION[ 'en_sesion' ] ) && isset( $_SESSION[ 'nivel' ] ) )
    {
        //Si hay sesión?
        if( $_SESSION[ 'en_sesion' ]."" == "1" )
        {
            $en_sesion = $_SESSION[ 'en_sesion' ];
            $nivel = $_SESSION[ 'nivel' ];
            
            //Asignamos la variable de la ruta a la cual vamos a llevar al usuario.
            if( isset( $_GET[ 'destino' ] ) )
            {
                $destino = $_GET[ 'destino' ];
                $destino = $obj_operaciones->encrypt_decrypt('decrypt', $destino ); //Se desencripta la ruta.
            }
            
        }else{
                header( "location: v_autenticacion.php" );
            }
        
    }else{
            header( "location: v_autenticacion.php" );
        }
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
                
                <?php
              
                    if( $en_sesion * 1 > 0 )
                    {
                        //echo "<hr>".$destino."<hr>";
                        
                        if( TRIM( $destino ) == "" ) $destino = $obj_operaciones->retornar_carpeta_principal().$obj_operaciones->ajustar_carpeta_nivel( $nivel );
                        
                        //echo $destino;
                        
                        //echo $obj_operaciones->listar_contenido( $destino );
                        echo $obj_operaciones->listar_contenido( $destino, "carpetas", 1 );
                        echo $obj_operaciones->listar_contenido( $destino, "archivos" );
                        
                        echo "<br>";               
                        
                    }else{
                        
                        echo "No est&aacute;s autorizado.";                
                    }        
                
                ?>
            
            </div>
        
        </div> <!-- container -->
        
        <hr>
        
        <!-- La caja de mensajes -->
        <div class="container">
        
            <?= $obj_operaciones->colocar_alerta( "Welcome - bienvenido.", "Please feel free to download all you want - por favor siéntete libre para descargar lo que quieras." ); ?>
        
        </div>
        
        <footer class="footer">
            <p>&copy; Company 2017-2018</p>
        </footer>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                
    </body>    
</html>

