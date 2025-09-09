//#region [CONSTANTES O VARIABLES GLOBALES] COMIENZO 
let esteFormulario;
let instanciaTabla;
let rutaAbsoluta = 'http://localhost/EXAMEN%20PINEDA/';
//#endregion [CONSTANTES O VARIABLES GLOBALES] FIN

async function peticionesAjax(instrucciones) {

    let formData = new FormData();
    let headers = new Headers();

    for (let [clave, valor] of Object.entries(instrucciones['datosPe'])) {
        formData.append(clave, valor);
    }
    let respuesta = await fetch(`${rutaAbsoluta}`+instrucciones['modulo'], {
        method: 'POST',
        headers: headers,
        mode: 'cors',
        body: formData,
    })

    if (!instrucciones['noJSON']) {
        respuesta = await respuesta.json();
    }

    return respuesta;
}
async function enviarFormulario() {

    esteFormulario = $(this);

    let resultado = await Swal.fire({
        title: '¿Estás seguro?',
        text: "Quieres realizar la acción solicitada",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    })

    if (resultado.isConfirmed) {

        let action = $(this).attr("action");
        let data = new FormData(this);

        let encabezados = new Headers();

        let config = {
            method: 'POST',
            headers: encabezados,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        };

        let respuesta = await (await fetch(action, config)).json()

        if (instanciaTabla) {
            instanciaTabla.ajax.reload(null, false);
        }

        console.log(respuesta);

        return alertas_ajax(respuesta);
    }
}
async function alertas_ajax(alerta) {

    switch (alerta.tipo) {
        case "simple":
            Swal.fire({
                icon: alerta.icono,
                title: alerta.titulo,
                text: alerta.texto,
                confirmButtonText: 'Aceptar'
            });
            break;
        case "limpiar":
            let resultado = await Swal.fire({
                icon: alerta.icono,
                title: alerta.titulo,
                text: alerta.texto,
                confirmButtonText: 'Aceptar'
            })
            if (resultado.isConfirmed) {
                if (esteFormulario) {
                    esteFormulario[0].reset();
                }
            }
            break;
        case "redireccionar":
            window.location.href = alerta.url
            break;
        default:
            console.log('Alerta no reconocida');
            break;
    }

}
async function plasmarDatosFomrAct() {

    let datosPe = {
        'modulo' : '?url=seccion',
        'datosPe' : {
            'accion' : 'seleccionarUnRegistro',
            'cedula' : this.value
        }
    }

    let respuesta = await peticionesAjax(datosPe);

    let idFormObjetivo = $(this).attr('data-bs-target');
    let formObjetivo = $(idFormObjetivo).find('form');
    let elementosForm = formObjetivo.find('input, select');

    elementosForm.each((indice, elemento) => {
        let name = $(elemento).attr('name')
        if(respuesta[name]){
            $(elemento).val(respuesta[name])
        }
    })
}
async function eliminarRegistros() {
    const cedula = this.value;
    let resultado = await Swal.fire({
        title: '¿Está seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar!',
        cancelButtonText: 'Cancelar'
    })
    if (resultado.isConfirmed) {
        let datosPe = {
            'modulo': '?url=seccion',
            'datosPe': {
                'accion': 'eliminar',
                'cedula': cedula
            }
        }
        let respuesta = await peticionesAjax(datosPe);
        if (instanciaTabla) {
            instanciaTabla.ajax.reload(null, false);
        }
        return alertas_ajax(respuesta)
    }
}
async function cerrarSesion() {
    let resultado= await Swal.fire({
        title: '¿Seguro que desea salir?',
        text: "¡Si lo hace deberá iniciar sesión de nuevo con su usuario y contraseña!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, salir!',
        cancelButtonText: 'No, cancelar'
    })
    if (resultado.isConfirmed) {
        let datosPe = {
            'modulo': '?url=seccion',
            'datosPe': {
                'accion': 'cerrarSesion',
            }
        }
        let respuesta = await peticionesAjax(datosPe);
        return alertas_ajax(respuesta)
    }
}

//#region [DELEGACIÓN DE LOS EVENTOS] COMIENZO
$(document).on('submit', '.formulario', function (e) {
    e.preventDefault();
    enviarFormulario.call(this);
});
$(document).on('click', '.botonActualizar', function (e) {
    e.preventDefault();
    plasmarDatosFomrAct.call(this)
})
$(document).on('click', '.btn-eliminar', async function () {
    eliminarRegistros.call(this)
});
$(document).on('click', '.btn-cerrar-sesion', async function (e) {
    e.preventDefault();
    cerrarSesion.call(this)
});
//#endregion [DELEGACIÓN DE LOS EVENTOS] FIN
