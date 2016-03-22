/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function initLoad()
{
    $('#divAlertInfo').fadeIn(500);
    $('#divAlertInfo').animate({
        'display': 'block'
    });
}

function endLoad()
{
    $('#divAlertInfo').delay(100).fadeOut(500);
    $('#divAlertInfo').animate({
        'display': 'none'
    });
}

function exito(data) {//  
    endLoad();
    $('#divAlertExito').delay(1000).fadeIn(500);
    $('#divAlertExito').animate({
        'display': 'block'
    });
    $("#msjOk").html(data); 

    $('#divAlertExito').delay(1000).fadeOut(500);
    $('#divAlertExito').animate({
        'display': 'none'
    });
    
}

function noExito(data) {
    endLoad();
    
    $('#divAlertWar').delay(1000).fadeIn(500);
    $('#divAlertWar').animate({
        'display': 'block'
    });
    $("#msjWar").html(data);    

    $('#divAlertWar').delay(5000).fadeOut(500);
    $('#divAlertWar').animate({
        'display': 'none'
    });
    

}

function validacionDeCaracters(id){
    $("#" + id).keypress(function (key) {
            window.console.log(key.charCode)
            if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
                && (key.charCode < 65 || key.charCode > 90) //letras minusculas
                && (key.charCode != 45) //retroceso
                && (key.charCode != 241) //ñ
                 && (key.charCode != 209) //Ñ
                 && (key.charCode != 32) //espacio
                 && (key.charCode != 225) //á
                 && (key.charCode != 233) //é
                 && (key.charCode != 237) //í
                 && (key.charCode != 243) //ó
                 && (key.charCode != 250) //ú
                 && (key.charCode != 193) //Á
                 && (key.charCode != 201) //É
                 && (key.charCode != 205) //Í
                 && (key.charCode != 211) //Ó
                 && (key.charCode != 218) //Ú
                 && (key.charCode != 109) //-
                )
                return false;
        });
}
function validaNumeros(id){
     $("#"+id).keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) || 
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
        }
 
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
}


