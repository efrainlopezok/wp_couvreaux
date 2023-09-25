jQuery(document).ready(function() {
    // var texto = jQuery('#typer').text();
    // var texto = "Texto Ejemplo / Ejemplo 2  / Ejemplo 3";
    //  maquina("typer",texto,80,0);
     function maquina(contenedor,texto,intervalo,n){
         var i=0,
          // Creamos el timer
          timer = setInterval(function() {
          if ( i<texto.length ) {
           // Si NO hemos llegado al final del texto..
           // Vamos añadiendo letra por letra y la _ al final.
           jQuery("#"+contenedor).html(texto.substr(0,i++));
          } else {
           // En caso contrario..
           // Salimos del Timer y quitamos la barra baja (_)
           clearInterval(timer);
           jQuery("#"+contenedor).html(texto);
           // Auto invocamos la rutina n veces (0 para infinito)
           if ( --n!=0 ) {
            setTimeout(function() {
             maquina(contenedor,texto,intervalo,n);
            },3600);
           }
          }
         },intervalo);
        };
        AOS.init();
        // var url = document.domain;
        // jQuery(location).attr('href',url);
        
        // document.location.href = url;
        if(jQuery("#username").length > 0){
            if(jQuery(".woocommerce-error").length > 0){
                var text=jQuery(".woocommerce-error").children("li").text();
                if(text.indexOf("Invalid username") > -1){
                    jQuery("#username").css("border", "1px solid red");
                }
                if(text.indexOf("The password") > -1){
                    jQuery("#password").css("border", "1px solid red");
                }
            }
            
        }

});
