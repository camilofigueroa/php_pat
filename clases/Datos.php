<?php

    /**
     * Autor: Camilo Figueroa (Crivera ).
     * Esta clase tiene como propósito el acceso único a la base de datos.
     *
     */

    include( "clases/Seguridad.php" );
     
    class Datos extends Seguridad
    {
        
        /**
         * Constructor de la clase.
         *
         */
        function Datos()
        {
            
        }
        
        /**
         * Retorna la conexion a la base de datos.
         * 
         * @return      conexion mysql          Retorna una conexión tipo MySQL.
         */
        function retornar_conexion()
        {
            include( "config.php" );
            
            //return  mysqli_connect( "localhost", "root", "camilof1234", "bd_php_pat" );
            return  mysqli_connect( $servidor, $usuario, $clave, $bd ); 
        }
        
        /**
         * Retorna cualquier dato de una tabla.
         * @param       texto           Representa una tabla específica del sistema.
         * @param       texto           Representa una columna, cálculo o dato a retornar.
         * @param       texto           Representa una condición para el sql.
         * @param       texto           Representa el order by.
         * @param       texto           Representa un parámetro que retornará una ruta, un dato u otras cosa.
         * @return      texto           Un dato( s ) específico del sistema.
         */
        function retornar_datos( $tabla, $columna = null, $condicion = null, $ordenamiento = null, $des = null )
        {
            $salida = "";
            
            $conexion = $this->retornar_conexion();
            
            if( $columna == null ) $columna = "*";
            if( $des == null ) $des = "1";
            $sql = " SELECT $columna FROM ".$tabla;
            if( $condicion != null ) $sql .= " WHERE ".$condicion; //Se adhiere la condición al sistema.
            if( $ordenamiento != null ) $sql .= " ORDER BY ".$ordenamiento; 
            
            //echo $sql;
            
            $resultado = $conexion->query( $sql );
            
            while( $fila = mysqli_fetch_array( $resultado ) )
            {
                switch( $des )
                {
                    case 1: //Esta opción es para lo normal.
                                $salida .= $fila[ 0 ];
                        break;
                    
                    case 2: //Esta opción es para cuando se necesita la ruta.
                                $salida = $salida."/".$fila[ 0 ];
                        break;
                }
                
            }
            
            //echo "<br>Salida = ".$salida."<br>";
            
            $conexion->close();
            
            return $salida;
        }
        
        /**
         * Escribe un archivo en una tabla. El índice o clave primaria ruta/nombre archivo impedirá que se registren
         * tuplas iguales.
         * @param       texto       Ruta del archivo
         * @param       texto       Nombre del archivo.
         * @param       texto       Fecha creación del archivo.
         * @return      Número      1 o 0 dependiendo de si se grabó el registro o no.
         */
        function insertar_archivo( $ruta, $archivo, $fecha_creacion )
        {          
            $salida = 0;
            
            $ruta               = TRIM( $ruta );
            $archivo            = TRIM( $archivo );
            $fecha_creacion     = TRIM( $fecha_creacion );
            
            //Había un error que estaba ocurriendo en las rutas, no era crítico pero obligaba a usar esta línea en muchas partes.
            //if( strpos( $ruta, "//" ) !== false ) $ruta = str_replace( "//", "/", $ruta );
            
            $conexion = $this->retornar_conexion();
            
            $sql  = " INSERT INTO tb_archivos ( ruta, archivo, sn_existe, fecha_creacion, fecha_registro ) ";
            $sql .= " VALUES( '$ruta', '$archivo', 1,  '$fecha_creacion', NOW() ) ";
            //echo $sql;
            
            $resultado = $conexion->query( $sql );
            
            if( $conexion->affected_rows > 0 )
            {
                $salida = 1;
            } 
            
            return $salida;            
        }
        
    }