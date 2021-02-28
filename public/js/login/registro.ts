//Cuando se mandan los datos llamamos a la funcion comprobarpass
    $("#formregist").on('submit',function (event){
        comprobarpass(event);
    });

//Función para comprobar si las contraseñas coinciden
    function comprobarpass(event){
        let password:string = $("#pass").val().toString();
        let repass:string = $("#repass").val().toString();

        try {
            if (password != repass){
                event.preventDefault();
                throw new Error;
            }
        }
        catch (err){
            $(".error").empty();
            $(".error2").empty();
            $(".error").append('<div class="alert alert-danger text-center mb-2">Las contraseñas no coinciden</div>');
        }
    }
