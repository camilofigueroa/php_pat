<?php

    /**
     * Autor: Camilo Figueroa ( Crivera )
     *
     *
     */

    include( "clases/Datos.php" );
     
    class Operaciones extends datos
    {        
        public $g_sitio_exterior = 0; //Variable para almacenar si las carpetas de patrocinio estarán interna o externamente.
        public $g_carpeta_nivel = ""; //Para almacenar la carpeta del nivel.
        
        /**
         * Constructor de la clase.
         *
         */
        public function Operaciones()
        {
            if( !isset( $_SESSION ) ) session_start();
            //echo $_SESSION[ 'nivel' ]." -> ";
            
            $this->ini();
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
         * @param
         * @return      
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
         * @param       texto       Un texto que indica si se desea la impresión de archivos o carpetas.
         * @param       texto       Un texto que indica si se desan algunas opciones de impresión.
         * @return      texto       Representa un html con la lista de carpetas y archvos en un nivel.
         */
        function listar_contenido( $ruta, $des = null, $imp_migas = null )
        {
            $salida = "";
            $directorio = opendir( $ruta ); //ruta actual
            $migas_pan = "";
            
            if( strpos( $ruta, "../" ) !== false ) $this->g_sitio_exterior = 1;
            
            if( isset( $_SESSION[ 'ruta' ] ) )
            {
                $_SESSION[ 'ruta' ] = $ruta;
                $migas_pan = $this->armar_migas_de_pan( $ruta ); //Arma la ruta para devolverse.
            }
            
            $entrar = false;
            //rsort( $directorio );
            
            while ( false != ( $archivo = readdir( $directorio ) ) ) //obtenemos un archivo y luego otro sucesivamente
            {
                if( $archivo != "." && $archivo != ".." && strpos( $archivo, ".php" ) === false ) //Omitimos el retroceso y phps.
                {                
                    if ( is_dir( $ruta."/".$archivo ) ) //verificamos si es o no un directorio
                    {
                        //$salida .= "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
                        if( $des == "carpetas" || $des == null )
                        $salida .= $this->convertir_enlace_o_no( $ruta, $archivo, "v_listado.php" ) . "<br />";
                        
                    }else{
                            //$salida .= $archivo . "<br />";
                            if( $des == "archivos" || $des == null )
                            $salida .= $this->convertir_enlace_o_no( $ruta, $archivo )."<br />";                            
                        }                        
                }
            }
            
            closedir( $directorio );            
            
            if( $imp_migas != null ) $salida = $migas_pan.$salida;
            
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
        function convertir_enlace_o_no( $ruta, $dato, $destino = null, $etiqueta = null )
        {
            if( $destino == null )
            {
                //Es archivo.
                $salida = "<a href='".$ruta."/".$dato."' target='_blank'><img src='img/".$this->retornar_tipo_archivo( $dato )."'></a>";
                $salida .= "<a href='".$ruta."/".$dato."' target='_blank'>".$dato."</a>";
                
            }else{
                    //Es carpeta.
                    
                    $tmp_ruta = $this->encrypt_decrypt( 'encrypt', $ruta ); //13/12/2018, ojo, la encriptación.
                    $salida = "<a href='$destino?destino=$tmp_ruta' target='_self'><img src='img/carpeta.jpg'></a>";
                    
                    if( $dato == null )
                    {
                        //Esta es para las Migas de Pan.
                        //$salida = "<a href='$destino?destino=$ruta' target='_self'>".$etiqueta."</a>";
                        $salida = "<a href='$destino?destino=$tmp_ruta' target='_self'><img src='img/volver.png'></a>";
                        
                    }else{
                            $tmp_ruta = $this->encrypt_decrypt( 'encrypt', $ruta."/".$dato ); //13/12/2018
                            $salida .= "<a href='$destino?destino=$tmp_ruta' target='_self'>".$dato."</a>";
                        }                    
                }            
                    
            return $salida;
        }
        
        /**
         * Esta función se encarga de armar el control migas de pan para que un usuario se pueda devolver a un anterior directorio.
         * Aquí sí se debe extraer el directorio raiz, para que el usuario no lo identifique en el sitio.
         * @param       texto           Un texto que representa la ruta en la cual a entrado el usuario.
         * @return      texto           Un texto que representa un html con el control migas de pan.
         */
        function armar_migas_de_pan( $ruta )
        {
            $ruta = $this->arreglar_ruta( TRIM( $ruta ) );
            $salida = "";
            $tmp_ruta = "";
            $nivel = $_SESSION[ 'nivel' ];
            $carpeta_nivel = $this->arreglar_ruta( TRIM( $this->ajustar_carpeta_nivel( $nivel ) ) );
            
            //Cuando la ruta es exterior a la carpeta, se tratará un poco diferente.
            if( $this->g_sitio_exterior == 1 )
            {
                $ruta = str_replace( $this->retornar_carpeta_principal()."/".$carpeta_nivel, "", $ruta );
            }
            
            $ruta = $this->arreglar_ruta( $ruta ); //Se quitan diagonales iniciales, finales y dobles.
                                    
            if( TRIM( $ruta ) != "" )
            {                
                if( $ruta != $carpeta_nivel ) //Quita el problema de que al entrar en un nivel, deja devuelta para el que lo contiene.
                {                       
                    $arreglo = explode( "/", $ruta );
                    //print_r( $arreglo );
                    
                    //Si la carpeta con el contenido está fuera del sitio, hay que tener cuidado con las rutas.
                    if( $this->g_sitio_exterior == 1 )
                    {
                        //Si la ruta de la miga de pan no contiene la carpeta principal, hay que agregársela.
                        if( strpos( $tmp_ruta, $this->retornar_carpeta_principal()."/".$carpeta_nivel ) === false )
                        $tmp_ruta = $this->retornar_carpeta_principal()."/".$carpeta_nivel."/".$tmp_ruta;
                    }                    
                    
                    $salida .= "<table><tr>";
                    
                    //Aquí empiezan a armarse los diferentes enlaces de las migas de pan.
                    for( $i = 0; $i < count( $arreglo ); $i ++ )
                    {
                        if( $i - 1 >= 0 ) $tmp_ruta .= $arreglo[ $i - 1 ]."/";                        
                        $salida .= "<td>".$this->convertir_enlace_o_no( $tmp_ruta, null, "v_listado.php", $tmp_ruta )."</td>";                        
                    }
                    
                    $salida .= "</table></tr><br>";
                }
            }
                        
            return $salida;
            //return "";
        }
        
        /**
         * Convierte un número que representa un nivel a su respectiva carpeta.
         * Este nivel proviene de la escogencia de la lista en el login.
         * También almacena esa carpeta en una variable global.
         * @param       Número       Número que representa un nivel.
         * @return      Texto        Texto que representa una carpeta del sistema.
         */
        function ajustar_carpeta_nivel( $nivel )
        {
            //Hay que trabajar las diferentes rutas que puede tener, superiores al nivel seleccionado.
            //No es suficiente con traer la carpeta porque físicamente hay contenencia de carpetas.
        
            $this->g_carpeta_nivel = $this->retornar_datos( "prm_claves", "carpeta_nivel", " nivel >= ".$nivel, " nivel DESC ", 2 );

            //echo $this->g_carpeta_nivel."______<br>";
            
            return $this->g_carpeta_nivel;
        }        
        
        /**
         * Retorna la carpeta principal desde donde se despliega todo.
         * @return      texto       Retorna la URL principal desde donde se despliega todo.
         */
        function retornar_carpeta_principal()
        {
            include( "config.php" );
            
            return $ruta_general;
        }
        
        /**
         * Retorna el nombre de una imagen según el tipo de archivo que le llegue como parámetro.
         * @param       texto       Nombre de un archivo para ser analizado.
         * @return      texto       El nombre del tipo de archivo o imagen de tipo de archivo.
         */
        function retornar_tipo_archivo( $nombre )
        {            
            $salida = "archivo.jpg";
            $nombre = strtolower( $nombre );
            
            if( strpos( $nombre, ".mp4" ) !== false )       $salida = "video.jpg";
            if( strpos( $nombre, ".flv" ) !== false )       $salida = "video.jpg";
            if( strpos( $nombre, ".wmv" ) !== false )       $salida = "video.jpg";
            
            return $salida;
        }
        
        /**
		 * La siguiente función se encarga de escribir algun d ato en un archivo de texto, puede servir para escribir un log o un listado
		 * de errores.
		 * @param  			texto  				Una cadena que será escrita en un archivo de texto.
		 * @param 			texto 				Nombre de un archivo que será creado en la carpeta actual.
		 */
		function escribir_archivo_txt( $cadena, $nombre_archivo )
		{
			include( "config.php" ); //Aquí se traen los parámetros de la base de datos.
			//Hay que recordar que solo debería existir un archivo que permita dicha configuración.
			//Para este caso el config ajusta elementos adicionales de configuración además de la base de datos.
			
            $archivo = fopen( $nombre_archivo.".txt", "w" ); //Esta instruccción crea el archivo.
            fwrite( $archivo, $cadena.PHP_EOL );
            fclose( $archivo );	
			
		}
        
        /**
         * Retorna el título de la aplicación desde el archivo config.
         * @return      texto       El título de la aplicación.
         */
        function retornar_titulo_app()
        {
            include( "config.php" );
            return $titulo_aplicacion;
        }
		
        /**
         * Quita primera diagonal, última, y otras cosas que se tienen planeadas.
         * Se usa principalmente para arreglar las migas de pan.
         * @param       texto       Ruta de una determinada carpeta.
         * @return      texto       La ruta arreglada.
         */
        function arreglar_ruta( $ruta )
        {
            $ruta = str_replace( "//", "/", $ruta ); //Se arregla un poco la ruta.
            
            //Si el primer caracter es diagoal, se quitará pues también afecta el explode.
            if( substr( $ruta, 0, 1 ) == "/" ) $ruta = substr( $ruta, 1 );
            
            //Se arregla la ruta porque el último caracter de diagonal daña la interpretación de estructuras de directorios.
            if( TRIM( substr( $ruta, strlen( $ruta ) - 1 ) ) == "/" ) $ruta = substr( $ruta, 0, strlen( $ruta ) - 1 );
            
            return $ruta;
        }
        
    }