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
                                    
                <form action="c_autenticar.php" method="post" class="col s12">
                    
                    <div class="form-group">
                    
                        <select name="nivel" class="form-control form-control-lg">
                            
                            <!-- Aquí se ajustan los niveles de carpetas, pero deben estar acordes y almacenados en la base de datos. -->
                            <option value="-1">Please select.</option>
                            <option value="10">Level - nivel: 10</option>
                            <option value="2">Level - nivel: 2</option>
                            <option value="1">Level - nivel: 1</option>
                            
                        </select>                            
                        
                        <br>
                        <!-- <label for="clave-formulario">Your password - tu contraseña: </label> -->
                        <input type="password" id="clave-formulario" class="form-control" name="clave" maxlength=50 placeholder="Your password - tu contraseña." required>
                        
                        <br>
                        
                        <input type="submit" value="Entrar">
                        <br>
                        <br>
                    
                    </div> <!-- class="form-group" Bootstrap -->
                    
                </form>
            
            </div>
               
        </div> <!-- container -->
                        
        <hr>
        
        <!-- La caja de mensajes -->
        <div class="container">
        
            <?php
                                        
                if( isset( $_GET[ 'error' ] ) ) echo $obj_operaciones->colocar_alerta( "Sorry - perdón.", $_GET[ 'error' ] ); 
                
            ?>
        
        </div>
        
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