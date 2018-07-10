<?php

    /**
     * Autor: Camilo Figueroa ( Crivera )
     *
     *
     */

    include( "clases/Operaciones.php" );

    $obj_operaciones = new Operaciones();
    
    //echo $obj_operaciones->listar_contenido( "usuarios" );
    
    //echo getcwd(); //Retorna directorio actual de trabajo.
    
    session_start();
    $_SESSION[ 'en_sesion' ] = 0;
    $_SESSION[ 'nivel' ] = -1;
        
?>

<html>
    <head>
        <title></title>  
    </head>
    
    <body>
        
        <form action="c_autenticar.php" method="post">
            
            <select name="nivel">
                <option value="10">Nivel 10</option>
                <option value="2">Nivel 2</option>
                <option value="1">Nivel 1</option>
            </select>
            
            <input type="text" name="clave">
            <input type="submit" value="Entrar">
            <br>
            <br>
            
            <?php
            
                if( isset( $_GET[ 'error' ] ) ) echo "<br>".$_GET[ 'error' ]."<br>";
            
            ?>
            
        </form>
        
    </body>
    
</html>