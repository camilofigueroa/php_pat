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
    if( !isset( $_SESSION ) ) session_start();
    if( !isset( $_SESSION['conteo_fallidos'] )) $_SESSION['conteo_fallidos'] = 0;
    $error = "You do not have access to this... No tienes acceso a esto...";
        
    //Si las variables post vienen y de conteo de irrupción, se verifican.
    if( isset( $_POST[ 'nivel' ] ) && isset( $_POST[ 'clave' ] ) && isset( $_SESSION['conteo_fallidos'] ) )
    {
        $nivel = $_POST[ 'nivel' ];
        $clave = $_POST[ 'clave' ];
        
        //En sesión puede tener cero para no sesión o cualquier otro valor, tomado de un conteo SQL.
        if( $_SESSION['conteo_fallidos'] < 5 )
        $en_sesion = $obj_operaciones->retornar_datos( "prm_claves", "count( clave ) AS conteo_clave", " clave = TRIM( '".$clave."' ) AND nivel = ".TRIM( $nivel ) ) * 1;
        
        if( $en_sesion * 1 > 0 )
        {
            $_SESSION[ 'en_sesion' ] = 1;
            $_SESSION[ 'nivel' ] = $nivel;
            
            header( "location: v_listado.php" );
            
        }else{
                $_SESSION['conteo_fallidos'] ++;
                header( "location: v_autenticacion.php?error=".$error );
            }
            
    }else{        
            header( "location: v_autenticacion.php?error=".$error );
        }
    
