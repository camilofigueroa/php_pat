<?php

    /**
     * Autor: Camilo Figueroa ( Crivera )
     * 
     */
    
    include( "clases/AES.class.php" );
    
    class Seguridad
    {        
        public $obj_aes;
        private $secret_key;
        private $secret_iv;
        
        /**
         * Constructor de la clase. Si llega a instanciarse la clase, se usará la función ini, de lo contrario deberá ser llamada
         * para poder aprovechar los objetos de la librería AES.
         * @param       texto       La ruta del config por si se necesita.
         */
        public function Seguridad( $ruta = null )
        {
            //include( $ruta."config.php" );  
            //$this->obj_aes = new AES( $clave_encriptacion );
            $this->ini( $ruta ); //Esto se cambia al 13/12/2018.
        }
        
        /**
         * Construida al 13/12/2018.
         * Inicializa algunos valores importantes, cuando no se carga el constructor.
         * Lo anterior puede suceder cuando la función usa herencia y no instanciamiento.
         * @param           texto           Una ruta que ayudará a usar el archivo de config, donde se encuentre.
         */
        public function ini( $ruta = null )
        {            
            include( $ruta."config.php" );
            $this->secret_key = $secret_key;
            $this->secret_iv = $secret_iv;
            //$this->obj_aes = new AES( $clave_encriptacion );
        }
        
        /**
         * Inicializa e instancia lo necesario para la clase de seguridad.
         * @return      objeto          Un objeto de tipo AES.
         */
        public function inicializar()
        {
            //include( $ruta."config.php" );  
            //$this->obj_aes = new AES( $clave_encriptacion );
        }
        
        /**
         * Encripta una cadena con AES.
         * @param       texto           Un cadena para encriptar.
         * @return      texto           Una cadena encriptada.
         */
        public function encriptar_aes( $cadena )
        {
            $salida = $cadena;
            
            //$salida = $this->obj_aes->encrypt( $cadena );
            //$salida = $this->convertir_cad_ascii( $salida );
            
            return $salida;
        }
        
        /**
         * Desencripta una cadena previamente encriptada con AES.
         * @param       texto           Un cadena para desencriptar.
         * @return      texto           Una cadena desencriptada.
         */
        public function desencriptar_aes( $cadena )
        {
            $salida = $cadena;
            
            //$salida = $this->convertir_ascii_cad( $cadena, 3 );
            //$salida = $this->obj_aes->decrypt( $salida );
            
            return $salida;
        }
        
        /**
         * Simple method to encrypt or decrypt a plain text string
         * initialization vector(IV) has to be the same when encrypting and decrypting
         * Esto viene del sitio https://gist.github.com/joashp/a1ae9cb30fa533f4ad94
         * 
         * @param string $action: can be 'encrypt' or 'decrypt'
         * @param string $string: string to encrypt or decrypt
         *
         * @return string
         */
        function encrypt_decrypt($action, $string)
        {
           $output = false;
        
           $encrypt_method = "AES-256-CBC";
           $secret_key = $this->secret_key;
           $secret_iv = $this->secret_iv;
        
           // hash
           $key = hash('sha256', $secret_key);
           
           // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
           $iv = substr(hash('sha256', $secret_iv), 0, 16);
        
           if ( $action == 'encrypt' )
           {
               $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
               $output = base64_encode($output);
               
           } else if( $action == 'decrypt' ) {
            
                    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
                }
        
           return $output;
           
           //return $string;
        }
        
        /**
         * Convierte una cadena de caracteres a su correspondiente representacion ascii.
         * @param       texto       Una cadena que será convertida a ASCII.
         * @param       texto       Una cadena que representa un separador para cortar el texto principal.
         * @return      texto       Una cadena convertida a ascii.
         */
        public function convertir_cad_ascii( $cadena, $separador = null )
        {
            $salida = "";
            $ceros = "";
            $arreglo = str_split( $cadena );
            
            for( $i = 0; $i < count( $arreglo ); $i ++ )
            {
                $ceros = "";
                
                switch( strlen( ord( $arreglo[ $i ] )."" ) )
                {
                    case 1:
                        
                            $ceros = "00";
                        
                        break;
                    
                    case 2:
                        
                            $ceros = "0";
                        
                        break;
                }
                
                $salida .= $ceros.ord( $arreglo[ $i ] ).( $separador == null? "": $separador );
            }
            
            //print_r( $arreglo );
            
            return $salida;
        }
        
        
        /**
         * Convierte una cadena de caracteres compuesta de ascii a su representacion en el alfabeto.
         * @param       texto       
         * @param       texto       
         * @return      texto       Una cadena de texto normal.
         */
        public function convertir_ascii_cad( $cadena, $longitud_fragmento = null )
        {
            $salida = "";
            $ceros = "";
            
            $arreglo = $longitud_fragmento == null ? str_split( $cadena ): str_split( $cadena, $longitud_fragmento );
            
            for( $i = 0; $i < count( $arreglo ); $i ++ )
            {
                $salida .= chr( $arreglo[ $i ] * 1 );
            }

            //$salida = implode( $arreglo );
            
            return $salida;
        }
        
        
        /**
         * Esta función se crea porque se necesita prpbar la henrencias desde la clase de seguridad, pasando por la BD
         * hasta la clase final.
         * @return      texto       Una cadena que representa un mensaje de texto.
         */
        public function probando_herencia()
        {
            return "Este es un mensaje de prueba desde la clase de seguridad..";
        }
        
    }