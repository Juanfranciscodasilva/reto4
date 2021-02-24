//Cuando se mandan los datos llamamos a la funcion comprobarpass
$("#formregist").on('submit', function (event) {
    comprobarpass(event);
});
//Función para comprobar si las contraseñas coinciden
function comprobarpass(event) {
    var password = $("#pass").val().toString();
    var repass = $("#repass").val().toString();
    try {
        if (password != repass) {
            event.preventDefault();
            throw new Error;
        }
    }
    catch (err) {
        $(".error").empty();
        $(".error").append('<div class="alert alert-danger text-center">Las contraseñas no coinciden</div>');
    }
}
