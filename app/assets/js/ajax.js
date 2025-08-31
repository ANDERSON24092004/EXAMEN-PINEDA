//#region [CONSTANTES O VARIABLES GLOABALES] COMIENZO 
let esteFormulario;
let instanciaTabla;

//#endregion [CONSTANTES O VARIABLES GLOABALES] FIN

async function peticionesAjax(instrucciones){

    let formData = new FormData();
    let headers = new Headers();

    for (let [clave, valor] of Object.entries(instrucciones['datosPe'])) {
        formData.append(clave, valor);
    }
    let respuesta = await fetch(`${rutaAbsoluta}` + instrucciones['modulo'], {
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
            break;
    }
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

        // if (instanciaTabla) {
        //     instanciaTabla.ajax.reload(null, false);
        // }

        return alertas_ajax(respuesta);
    }
}

//#region [DELEGACIÓN DE LOS EVENTOS] COMIENZO
$(document).on('submit', '.formualario', function (e) {
    e.preventDefault();
    enviarFormulario.call(this)
})
//#endregion [DELEGACIÓN DE LOS EVENTOS] COMIENZO
