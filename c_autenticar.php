<?php

    /**
     * Autor: Camilo Figueroa ( Crivera )
     *
     *
     *
     */
    
    include( "clases/Operaciones.php" );
    $obj_operaciones = new Operaciones();
 
    $en_sesion = 0;
    session_start();
    $error = "You do not have acces to this... No tienes acceso a esto...";
        
    //Si las variables post vienen, se verifican.
    if( isset( $_POST[ 'nivel' ] ) && isset( $_POST[ 'clave' ] ) )
    {
        $nivel = $_POST[ 'nivel' ];
        $clave = $_POST[ 'clave' ];
        
        //En sesión puede tener cero para no sesión o cualquier otro valor, tomado de un conteo SQL.
        $en_sesion = $obj_operaciones->retornar_datos( "prm_claves", "count( clave ) AS conteo_clave", " clave = TRIM( '".$clave."' ) AND nivel = ".TRIM( $nivel ) ) * 1;
        
        if( $en_sesion * 1 > 0 )
        {
            $_SESSION[ 'en_sesion' ] = 1;
            $_SESSION[ 'nivel' ] = $nivel;
            
            
            header( "location: v_listado.php" );
            
        }else{
                header( "location: v_autenticacion.php?error=".$error );
            }
            
    }else{
            header( "location: v_autenticacion.php?error=".$error );
        }
    
