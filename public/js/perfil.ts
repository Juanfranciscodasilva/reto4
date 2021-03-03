//Cuando cambie la imagen se ejecutará el formulario
    $("#foto").on("change", function (){
        $("#formimagen").submit();
    });

//Cuando pulse en el enlace sacará un alert y en caso de que confirme se eliminará el usuario
    function eliminarusuario(){
        if (confirm('¿Estas segur@ de que deseas eliminar la cuenta?')){
            $.ajax({
                url: "/eliminarusuario",
                method: "get",

                success: function (response) {
                    alert(response);
                    location.href = '/';
                }
            })
        }
    }
