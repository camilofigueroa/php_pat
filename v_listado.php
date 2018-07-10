<?php

    /**
     * Autor: Camilo Figueroa ( Crivera )
     *
     *
     *
     */
    
    include( "clases/Operaciones.php" );
    $obj_operaciones = new Operaciones();
 
    session_start();
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
            if( isset( $_GET[ 'destino' ] ) ) $destino = $_GET[ 'destino' ];
            
        }else{
                header( "location: v_autenticacion.php" );
            }
        
    }else{
            header( "location: v_autenticacion.php" );
        }
?>

<html>
    <head>
        <title></title>  
    </head>
    
    <body>
        
        <a href="v_autenticacion.php">Home - Inicio.</a>
        
        <br>
        <br>
        
        <?php
      
            if( $en_sesion * 1 > 0 )
            {
                //echo "<hr>".$destino."<hr>";
                
                if( TRIM( $destino ) == "" ) $destino = $obj_operaciones->retornar_carpeta_principal().$obj_operaciones->ajustar_carpeta_nivel( $nivel );
                
                echo $obj_operaciones->listar_contenido( $destino );
                
                echo "<br>";               
                
            }else{
                
                echo "No est&aacute;s autorizado.";                
            }        
        
        ?>
        
    </body>    
</html>

