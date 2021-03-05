//Cuando cambie la imagen se ejecutará el formulario
$("#foto").on("change", function () {
    $("#formimagen").submit();
});
function cambiarFotoDePerfil() {
    if (validarArchivo()) {
        return true;
    }
    return false;
}
//Cuando pulse en el enlace sacará un alert y en caso de que confirme se eliminará el usuario
function eliminarusuario() {
    if (confirm('¿Estas segur@ de que deseas eliminar la cuenta?')) {
        $.ajax({
            url: "/eliminarusuario",
            method: "get",
            success: function (response) {
                alert(response);
                location.href = '/';
            }
        });
    }
}
function validarArchivo() {
    try {
        var archivoFile = document.querySelector("#foto").files[0];
        if (archivoFile.size == undefined) {
                return false;
            }
        var archivo = archivoFile.name;
        var extension = archivo.substring(archivo.lastIndexOf('.'), archivo.length);
        extension = extension.substring(1, extension.length);
        extension = extension.toLowerCase();
        if (extension == "jpg" || extension == "jpeg" || extension == "png" || extension == "pdf") {
            if (archivoFile.size <= 1000000) {
                return true;
            }
            throw "El archivo excede el peso máximo";
        }
        throw "Tipo de Archivo no válido, selecciona una imagen";
    }
    catch (e) {
        alert(e);
        return false;
    }
}
