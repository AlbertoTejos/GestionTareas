function Registro(){
    
    
}

Registro.prototype.procesoEnviaForm = function(classFrm,url,btn,urlCarga){
$("#" + btn).attr('disabled', 'disabled');
 $("#" + btn).attr('disabled', 'disabled');
       initLoad();
      var formData = new FormData($("." + classFrm)[0]);
     
        $.ajax({
             type:"POST", 
             url:url,
             data:formData,
             cache: false,
             contentType: false,
             processData: false,
             beforeSend: function () {
             },
             success:function(data)
             { 
                
                  var reply = data.replace(/\s+/, "");// se tiene que implementar de esta forma ya que el actual
                  //jQuery tiene errores en tomar los datos desde el servidor.
                     if(reply !== "OK"){
                    //$("#msjWar").html(data);
                    noExito(data);
                    $("#" + btn).delay(2000).queue(function (m)
                            {
                                $("#" + btn).removeAttr("disabled");
                                m();
                            });
                 }  
                 else{
                               
                            $("#" + btn).delay(5000).queue(function (m)
                            {
                                $("#" + btn).removeAttr("disabled");
                                m();
                            });
                            
                            if(urlCarga !== ''){
                                $("#ML_divPopup").html('<div class="alert alert-dismissable alert-success"><strong>Terminado</strong><br/> Proceso realizado con &eacute;xito.</div>');
                                setTimeout("location.href = '"+urlCarga+"'", 2000);
                            }
                            else{
                               exito('Se ha creado el usuario en forma correcta'); 
                            }
                 }   
                               
                            
            }                
             
         });
         return false;        
    
}