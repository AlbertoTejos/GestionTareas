function Modulo() {



}
Modulo.prototype.abreModal = function (urlCarga, titulo, id) {

    $.ajax({
        type: "POST",
        url: urlCarga,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (data)
        {

            $("#ML_tituloForm").html(titulo + ' ' + id);
            $("#ML_divPopup").html(data);


        }



    });
    return false;
}

Modulo.prototype.procesoEnviaForm = function (classFrm, url, btn, urlCarga) {
    $("#" + btn).attr('disabled', 'disabled');
    $("#" + btn).attr('disabled', 'disabled');
    initLoad();
    var formData = new FormData($("." + classFrm)[0]);

    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (data)
        {

            var reply = data.replace(/\s+/, "");// se tiene que implementar de esta forma ya que el actual
            //jQuery tiene errores en tomar los datos desde el servidor.
            if (reply !== "OK") {
                //$("#msjWar").html(data);
                noExito(data);
                $("#" + btn).delay(2000).queue(function (m)
                {

                    $("#" + btn).removeAttr("disabled");
                    m();
                    endLoad();

                });

                if ((btn != 'btnElimina') || (btn != 'btnModifica')) {
                    //Campos vacíos requeridos
                    //soporte inputs y listas desplegables
                    $('.' + classFrm + ' input, .' + classFrm + ' select').each(function () {
                        //var input = $(this); 
                        if (!$(this).val()) {
                            $(this).css('border-color', 'red');
                        } else {
                            $(this).css('border', '');
                        }

//                    var soloNumeros = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
//                    var soloLetras;
//                    var noCaracteresEspeciales = /^\s*[a-zA-Z0-9,\s]+\s*$/;
//                    
//                    //9
//                    var tamanoMaximo = /^([a-zA-Z0-9]{0,9})$/;
//                    
//                    if $(this).val()) {
//                        
//                    }

                    });
                }
            } else {

                $("#" + btn).delay(5000).queue(function (m)
                {
                    $("#" + btn).removeAttr("disabled");
                    m();
                });

                if (urlCarga !== '') {
                    endLoad();
                    $("#ML_divPopup").html('<div class="alert alert-dismissable alert-success"><strong>Terminado</strong><br/> Proceso realizado con &eacute;xito.</div>');
                    setTimeout("location.href = '" + urlCarga + "'", 2000);
                } else {
                    endLoad();
                    exito('Se ha creado el usuario en forma correcta');

                }
            }


        }

    });
    return false;

}


