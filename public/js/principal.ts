$(document).ready(function () {
    guardardato();
    botonmodoscyclaro();
    var x = window.matchMedia("(max-width:992px");
    x.addListener(propiedadesCssMenu);
});

//Funcion para ocultar el menu cada vez que coincide con la distribucion de la pantalla
function propiedadesCssMenu(ventana):void {
    if (ventana.matches) {
        $("body").removeClass('sb-sidenav-toggled');
    }
    else
        $("body").addClass('sb-sidenav-toggled');
}

//Funcion para saber si la sesion esta en modo oscuro o modo claro para cada pagina y para cuando cierre sesion
function guardardato():void{
    let localstorage:string = localStorage.getItem("modo");
    if (localstorage != null && localstorage === "oscuro"){
        $("body").addClass('dark');
        $("#switch").addClass("active");
        modooscyclaro('/img/logo_blanco.PNG',"oscuro");
    }
    else
    {
        $("body").removeClass('dark');
        $("#switch").removeClass("active");
        modooscyclaro('/img/logo.PNG',"claro");
    }
}

//Función que se utiliza para modificar el valor del boton y hacer el cambio de modo claro a modo oscuro y viceversa
function botonmodoscyclaro():void{
    var boton = document.querySelector('#switch');
    boton.addEventListener('click', function () {
        document.body.classList.toggle('dark');
        boton.classList.toggle('active');

        let body = document.getElementById('bod');
        if (body.classList.contains('dark'))
            modooscyclaro('/img/logo_blanco.PNG',"oscuro");
        else
            modooscyclaro('/img/logo.PNG',"claro");
    });
}

//Modificar el logo dependiendo del color de la pagina
function modooscyclaro(url,modo):void{
    $(".logo").attr('src',url);
    localStorage.setItem("modo",modo);
}

//Funcion para mostrar el perfil del usuario
function mostrarperfil(event,idusu){
    event.preventDefault();
    location.href = '/perfilusu/' + idusu.id;
}

function aceptarDesvinculoEliminar(id){
    if (confirm("¿Estás seguro/a de desvincular/eliminar este proyecto")){
        window.location.href = "/eliminarProyecto/"+id;
    }
}

function añadirfavorito(boton,event){
    event.preventDefault();
    location.href = '/anadirfavorito/' + boton.id;
}

function quitarfavorito(boton,event){
    event.preventDefault();
    location.href = '/quitarfavorito/' + boton.id;
}
