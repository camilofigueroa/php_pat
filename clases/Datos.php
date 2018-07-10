<?php

    class Datos
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
         *
         */
        function retornar_conexion()
        {            
            return  mysqli_connect( "localhost", "root", "camilof1234", "bd_php_pat" ); 
        }
        
        /**
         * Retorna cualquier dato de una tabla.
         * @param       texto           Representa una tabla específica del sistema.
         * @param       texto           Representa una columna, cálculo o dato a retornar.
         * @param       texto           Representa una condición para el sql.
         * @param       texto           Representa uel order by.
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
            
            //echo $salida;
            
            $conexion->close();
            
            return $salida;
        }
        
    }