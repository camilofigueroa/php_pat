<?php

    /**
     * Autor: Camilo Figueroa ( Crivera )
     *
     *
     */

    include( "clases/Datos.php" );
     
    class Operaciones extends datos
    {
        /**
         * Constructor de la clase.
         *
         */
        public function Operaciones()
        {
            
        }
        
        
        /**
         * Esta función se encarga de listar los archivos y carpetas retornándolos en un vector.
         * Es original del sitio oficial de php. Sin embargo la lista es en árbol, y despliega subvectores. Es compleja.
         * @param       texto           Un texto que representa una dirección o subcarpeta.
         * @return      array           Arreglo con datos de carpetas y archivos.
         */
        function listar_carpeta( $dir )
        {  
            $result = array();
         
            $cdir = scandir($dir);
            
            foreach ($cdir as $key => $value)
            {
               if (!in_array($value,array(".","..")))
               {
                  if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                  {
                     $result[$value] = $this->listar_carpeta($dir . DIRECTORY_SEPARATOR . $value);
                  }
                  else
                  {
                     $result[] = $value;
                  }
               }
            }
           
            return $result;
        } 
        
        
        /**
         * Esta función se encarga de organizar un contenido de un vector retornando salidas html.
         * Está incompleta o sin usar.
         */
        function organizar( $datos ) 
        {
            $salida = "";
            
            for( $i = 1; $i < count( $datos ); $i ++ )
            {
                $salida .= $datos[ $i ]."<br>";
            }            
            
            return $salida;
        }
        
        
        /**
         * Este código es de http://www.elcodigofuente.com/leer-archivos-directorio-carpeta-php-812/
         * @param       texto       Un texto que representa una ruta a listar.
         * @return      texto       Representa un html con la lista de carpetas y archvos en un nivel.
         */
        function listar_contenido( $ruta )
        {
            $salida = "";
            $directorio = opendir( $ruta ); //ruta actual
            
            while ( false != ( $archivo = readdir( $directorio ) ) ) //obtenemos un archivo y luego otro sucesivamente
            {
                
                if( $archivo != "." && $archivo != ".." && strpos( $archivo, ".php" ) === false ) //Omitimos el retroceso y phps.
                {                
                    if ( is_dir( $ruta."/".$archivo )) //verificamos si es o no un directorio
                    {
                        //$salida .= "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
                        $salida .= $this->convertir_enlace_o_no( $ruta, $archivo, "v_listado.php" ) . "<br />";
                        
                    }else{
                            //$salida .= $archivo . "<br />";
                            $salida .= $this->convertir_enlace_o_no( $ruta, $archivo ) . "<br />";
                        }                        
                }
            }
            
            closedir( $directorio );
            
            return $salida;
        }
        
        
        /**
         * Convierte el nombre de un archivo a su enlace. En el caso de carpetas, debe suministrar un enlace que permita a la
         * aplicación saber qué directorio listará.
         * @param       texto       Texto que representa una ruta específica.
         * @param       texto       Texto que representa el nombre de un archivo o carpeta.
         * @param       texto       Ruta que representa el nombre del archivo al cual debe ir para listar la carpeta.
         * @return      texto       Texto que representa un enlace html para ser puesto en pantalla.
         */
        function convertir_enlace_o_no( $ruta, $dato, $destino = null )
        {
            if( $destino == null )
            {
                $salida = "<a href='".$ruta."/".$dato."' target='_blank'>".$dato."</a>";                     
                
            }else{
                    $salida = "<a href='$destino?destino=$ruta/$dato' target='_self'>[".$dato."]</a>";
                }
            
                    
            return $salida;
        }
        
        /**
         * Convierte un número que representa un nivel a su respectiva carpeta.
         * @param       Número       Número que representa un nivel.
         * @return      Texto        Texto que representa una carpeta del sistema.
         */
        function ajustar_carpeta_nivel( $nivel )
        {
            //Hay que trabajar las diferentes rutas que puede tener, superiores al nivel seleccionado.
            //No es suficiente con traer la carpeta porque físicamente hay contenencia de carpetas.
            
            return $this->retornar_datos( "prm_claves", "carpeta_nivel", " nivel >= ".$nivel, " nivel DESC ", 2 );
        }
        
        
        /**
         * Retorna la carpeta principal desde donde se despliega todo.
         * @return      texto       Retorna la URL principal desde donde se despliega todo.
         */
        function retornar_carpeta_principal()
        {
            return "usuarios";
        }
    }