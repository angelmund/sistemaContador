import { alertaInfo, confirSave, eliminar } from "./alertas";

// Declaración de la variable btnSubmit*

// const btnSubmit = document.querySelector('#btn_save');*

// let formularioValido;*

document.addEventListener('DOMContentLoaded', function () {
    if ($('#form-usuario').length > 0) {

        const formulario = document.querySelector('#form-usuario');

        const limpiar = document.querySelector('#limpiar');

        limpiar.addEventListener('click', (e) => {
            e.preventDefault();
            formulario.reset();
        });

        formulario.addEventListener('submit', async function (event) {
            event.preventDefault(); // Evita que el formulario se envíe automáticamente

            if (!formulario.checkValidity()) {
                event.stopPropagation();
                alertaInfo("Faltan datos por completar");
                formulario.classList.add('was-validated'); // Marcar campos inválidos
                return;
            }else{
                confirSave("¿Los datos capturados son correctos?", function () {
                    saveCheque();
                });
            }
        });
    }

    const btnEliminar = document.querySelectorAll('.eliminar-user');

btnEliminar.forEach(btn => {
    btn.addEventListener('click', eliminarUsuario);
});

function eliminarUsuario(event) {
    const id = event.currentTarget.dataset.id; // Obtener el ID del usuario del botón
    const ruta = $('#url').val();
    const url ='/usuarios/delete/' + id; // Actualizar la URL para eliminar un usuario

    eliminar("¿Seguro que desea eliminar el usuario?", function (){
        eliminarUsuarioFetch(url); // Pasar la URL como parámetro
    });
}

async function eliminarUsuarioFetch(url) {
    try {
        const response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        });

        const data = await response.json();

        if (data.idnotificacion == 1) {
            Swal.fire({
                title: "Eliminado con éxito",
                icon: "success",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
            });
            setTimeout(function () {
                window.location.reload();
            }, 1500);
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ocurrió un error al eliminar"
            });
        }
    } catch (error) {
        console.error('Error en try-catch:', error);
    }
}

});

async function saveCheque() {
    const url = $('#url').val();
    const formData = new FormData($('#form-usuario')[0]);
    try {
        const response = await fetch(url + '/usuarios/delete', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: formData
        });
        const data = await response.json();
        handleResponse(data);
    } catch (error) {
        console.error("Error al procesar la solicitud:", error);
    }
}

async function savePago() {
    const url = $('#url').val();
    const formData = new FormData($('#form-usuario')[0]);
    formData.append('referencia', $('#referencia').val());
    formData.append('monto', $('#monto').val());
    formData.append('observaciones', $('#observaciones').val());
    formData.append('id_cliente', $('#id_cliente').val());
    formData.append('id_proyecto', $('#id_proyecto').val());
    try {
        const response = await fetch(url + '/listaPagos/ingreso', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: formData
        });
        const data = await response.json();
        handleResponse(data);
    } catch (error) {
        console.error("Error al procesar la solicitud:", error);
    }
}

function handleResponse(data) {
    if (data.idnotificacion == 1) {
        Swal.fire({
            title: "Agregado con éxito",
            icon: "success",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        });
        setTimeout(function () {
            document.getElementById('form-usuario').reset();
            window.location.reload();
        }, 1500);
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ocurrió un error al guardar!"
        });
    }
}
