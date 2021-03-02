$("#mensajes").scrollTop($("#mensajes").prop('scrollHeight'));
function validarDatosCrearProyecto() {
    var validado = true;
    if (!validarFechaVencimiento()) {
        validado = false;
    }
    if (!validarIntegranteSeleccionado()) {
        validado = false;
    }
    return validado;
}
function validarFechaVencimiento() {
    try {
        var actual = new Date();
        var seleccionada = new Date($("#fecha").val());
        if (seleccionada < actual) {
            throw "Fecha seleccionada pasada";
        }
        $("#errorFecha").css("display", "none");
        $("#time").val(seleccionada.getTime());
        return true;
    }
    catch (e) {
        $("#errorFecha").css("display", "block");
        return false;
    }
}
function validarIntegranteSeleccionado() {
    try {
        var seleccionado = $("#asignar").val();
        if (seleccionado == "null") {
            throw "Selecciona un integrante";
        }
        $("#errorIntegrante").css("display", "none");
        return true;
    }
    catch (e) {
        $("#errorIntegrante").css("display", "block");
        return false;
    }
}
var archivosAdjuntosString = [];
var archivosAdjuntos = [];
$("#archivoChat").change(function () {
    var archivo = document.querySelector("#archivoChat").files[0];
    if (archivo != "") {
        archivosAdjuntosString.push(archivo.name);
        if (validarArchivo(archivo)) {
            addListaInputs("noerror");
        }
        else {
            addListaInputs("error");
        }
        $('#archivoChat').val("");
    }
});
function validarArchivo(archivoFile) {
    try {
        var archivo = archivoFile.name;
        var extension = archivo.substring(archivo.lastIndexOf('.'), archivo.length);
        extension = extension.substring(1, extension.length);
        extension = extension.toLowerCase();
        if (extension == "jpg" || extension == "jpeg" || extension == "png" || extension == "pdf") {
            if (archivoFile.size <= 5000000) {
                return true;
            }
            throw "El archivo excede el peso máximo";
        }
        throw "Tipo de Archivo no válido";
    }
    catch (e) {
        return false;
    }
}
function addListaInputs(tipo) {
    var posi = archivosAdjuntosString.length - 1;
    var posi2 = archivosAdjuntos.length;
    var nombre = archivosAdjuntosString[posi].substring(archivosAdjuntosString[posi].lastIndexOf("\\"), archivosAdjuntosString[posi].length);
    var extension = archivosAdjuntosString[posi].substring(archivosAdjuntosString[posi].lastIndexOf('.'), archivosAdjuntosString[posi].length);
    extension = extension.substring(1, extension.length);
    extension = extension.toLowerCase();
    if (tipo == "error") {
        $("#listaArchivos").append("<li id='li" + posi + "' style='color: red'><span><i class='fas fa-exclamation-triangle iconoArchivo'></i></span>" + nombre + "<i class='fas fa-times iconoCerrar' onclick='eliminarArchivo(" + posi + ")'></i></li>");
    }
    else {
        if (extension == "pdf") {
            $("#listaArchivos").append("<li id='li" + posi + "'><span style='color: red'><i class='fas fa-file-pdf iconoArchivo'></i></span>" + nombre + "<i class='fas fa-times iconoCerrar' onclick='eliminarArchivo(" + posi + ")'></i></li>");
        }
        else {
            $("#listaArchivos").append("<li id='li" + posi + "'><span><i class='fa fa-image iconoArchivo'></i></span>" + nombre + "<i class='fas fa-times iconoCerrar' onclick='eliminarArchivo(" + posi + ")'></i></li>");
        }
    }
    var input = document.querySelector("#archivoChat").cloneNode();
    input.setAttribute("id", "archivo" + posi2);
    input.setAttribute("name", "archivo" + posi2);
    $("#inputsHidden").append(input);
    $("#inputsHidden").append("<input type='hidden' name='nombreArchivo" + posi + "' value='" + nombre + "'>");
    archivosAdjuntos.push(input);
}
function generarListaInputsArchivos() {
    $("#listaArchivos").empty();
    $("#inputsHidden").empty();
    for (var x = 0; x < archivosAdjuntosString.length; x++) {
        var nombre = archivosAdjuntosString[x].substring(archivosAdjuntosString[x].lastIndexOf("\\"), archivosAdjuntosString[x].length);
        var extension = archivosAdjuntosString[x].substring(archivosAdjuntosString[x].lastIndexOf('.'), archivosAdjuntosString[x].length);
        extension = extension.substring(1, extension.length);
        extension = extension.toLowerCase();
        if (extension == "pdf") {
            $("#listaArchivos").append("<li id='li" + x + "'><span style='color: red'><i class='fas fa-file-pdf iconoArchivo'></i></span>" + nombre + "<i class='fas fa-times iconoCerrar' onclick='eliminarArchivo(" + x + ")'></i></li>");
        }
        else {
            if (extension == "jpg" || extension == "jpeg" || extension == "png") {
                $("#listaArchivos").append("<li id='li" + x + "'><span><i class='fa fa-image iconoArchivo'></i></span>" + nombre + "<i class='fas fa-times iconoCerrar' onclick='eliminarArchivo(" + x + ")'></i></li>");
            }
            else {
                $("#listaArchivos").append("<li id='li" + x + "' style='color: red'><span><i class='fas fa-exclamation-triangle iconoArchivo'></i></span>" + nombre + "<i class='fas fa-times iconoCerrar' onclick='eliminarArchivo(" + x + ")'></i></li>");
            }
        }
        archivosAdjuntos[x].setAttribute("id", "archivo" + x);
        archivosAdjuntos[x].setAttribute("name", "archivo" + x);
        $("#inputsHidden").append(archivosAdjuntos[x]);
        $("#inputsHidden").append("<input type='hidden' name='nombreArchivo" + x + "' value='" + nombre + "'>");
    }
}
function eliminarArchivo(posi) {
    archivosAdjuntosString.splice(posi, 1);
    archivosAdjuntos.splice(posi, 1);
    generarListaInputsArchivos();
}
function enviarComentario() {
    for (var x = 0; x < archivosAdjuntos.length; x++) {
        if (!validarArchivo(archivosAdjuntos[x].files[0])) {
            $("#textoArchivosAdjuntos").css("color", "red");
            return false;
        }
    }
    return true;
}
function revisarExistenciaDeArchivos() {
    if (archivosAdjuntos.length == 0) {
        $("#textoArchivosAdjuntos").css("color", "red");
        return false;
    }
    var enviar = enviarComentario();
    return enviar;
}
