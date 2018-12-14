






/**
* Función que realiza un seguimiento de un clic en un enlace saliente en Analytics.
* Esta función toma una cadena de URL válida como argumento y la utiliza
* como la etiqueta del evento. Configurar el método de transporte como "beacon" permite que el hit se envíe
* con "navigator.sendBeacon" en el navegador que lo admita.
*/
var trackOutboundLink = function( url ) 
{
    gtag('event', 'clic', {
      'event_category': 'saliente',
      'event_label': url,
      'transport_type': 'beacon',
      'event_callback': function(){document.location = url;}
    });
}



function aceptar_negar_cookies()
{
    if( confirm( "This site uses cookies to improve the services offered. If you go on surfing, we will consider you accepting its use. - Este sitio utiliza cookies para mejorar los servicios que se ofrecen. Si continúas navegando, consideramos que aceptas su uso." ) )
    {
        window.location.replace( "v_autenticacion.php" );
        
    }else{
        
        window.location.replace( "#" );
    }
}
 