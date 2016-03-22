function Login(){
    
    
}

Login.prototype.procesoEnviaForm = function(classFrm,url,btn,urlCarga){
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
                               
                            $("#" + btn).delay(2000).queue(function (m)
                            {
                                $("#" + btn).removeAttr("disabled");
                                m();
                            });
                            
                            if(urlCarga !== ''){
                               
                                setTimeout("location.href = '"+urlCarga+"'", 0);
                            }
                            else{
                               exito('Datos Guardados de formar correcta!'); 
                            }
                 }   
                               
                            
            }                
             
         });
         return false;        
    
}/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


