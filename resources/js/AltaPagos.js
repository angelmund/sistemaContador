import { alertaInfo, confirSave } from "./alertas";
// import Swal from 'sweetalert2';

// Declaración de la variable btnSubmit*

// const btnSubmit = document.querySelector('#btn_save');*

// let formularioValido;*

document.addEventListener('DOMContentLoaded', function () {
    if ($('#formAlta-pagos').length > 0) {

        const formulario = document.querySelector('#formAlta-pagos');

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
            }

            var conceptoSeleccionado = $('#concepto_pago').val();

            if (conceptoSeleccionado === 'cheque') {
                confirSave("¿Los datos capturados son correctos?", function () {
                    saveCheque();
                });
            } else if (conceptoSeleccionado === 'pago') {
                confirSave("¿Los datos capturados son correctos?", function () {
                    savePago();
                });
            }
        });
    }
});

async function saveCheque() {
    const url = $('#url').val();
    const formData = new FormData($('#formAlta-pagos')[0]);
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

async function savePago() {
    const url = $('#url').val();
    const formData = new FormData($('#formAlta-pagos')[0]);
    formData.append('referencia', $('#referencia').val());
    formData.append('monto', $('#monto').val());
    formData.append('observaciones', $('#observaciones').val());
    formData.append('id_cliente', $('#id_cliente').val());
    formData.append('id_proyecto', $('#id_proyecto').val());
    console.log(formData);
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
    switch (data.idnotificacion) {
        case 1:
            const url = $('#url').val();
            // Abre la URL de la vista en una nueva pestaña
            const vistaUrl = url + '/formatoPago/' + data.pagoId;
            window.open(vistaUrl, '_blank');

            // Esperar un breve período de tiempo antes de recargar la página
            setTimeout(function () {
                document.getElementById('formAlta-pagos').reset();
                window.location.reload();
            }, 1000); // Espera 1 segundo
            break;
        case 2:
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "El monto del cheque supera el total de los pagos realizados por el cliente."
            });
            break;
        case 3:
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Error al guardar el pago: " + data.mensaje
            });
            break;
        case 4:
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "El cliente no tiene pagos registrados."
            });
            break;
        default:
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ocurrió un error desconocido."
            });
            break;
    }
}


// Escucha cambios en el elemento select   de clientes para cargar los nombres de cada cliente 
$('#id_cliente').change(function () {
    var idSeleccionado = $(this).val();
    console.log(idSeleccionado);
    if (idSeleccionado) {
        $.get('/inscripciones/relacion/nombre/' + idSeleccionado, function (data) {
            if (data && data.nombre_completo) {
                $('#nombre').val(data.nombre_completo);
            } else {
                $('#nombre').val('');
            }
        }).fail(function () {
            $('#nombre').val('');
        });
    } else {
        $('#nombre').val('');
    }
});

 // Escucha cambios en el elemento select
//  $('#id_proyecto').on('change', function () {
//     const nombreProyectoInput = document.querySelector('#nombreProyecto_n');
//     const inscripcion = {

//     };
//     var claveProyecto = $(this).val();
//     const claveProyectoValue = $('#id_proyecto').val();
//     var nombreProyectoSeleccionado = this.options[this.selectedIndex].text; // Obtiene el texto de la opción seleccionada
//     console.log("Has seleccionado: " + nombreProyectoSeleccionado);
//     console.log(claveProyectoValue);

//     $.get('/inscripciones/relacion/' + claveProyecto, function (data) {
//         if (data && data.clave_proyecto) {
//             // Actualiza el valor del campo en el objeto inscripcion
//             inscripcion.claveProyecto = data.clave_proyecto; // Actualiza la clave del proyecto
//             inscripcion.nombreProyecto_n = data.nombre_proyecto; // Actualiza el nombre del proyecto

//             var nombresProyectos = '';

//             //  actualizar el valor de nombreProyectoInput si tienes un nombre
//             if (data.nombre_proyecto) {
//                 nombresProyectos = data.nombre_proyecto;
//             }

//             nombreProyectoInput.value = nombresProyectos;

//         } else {
//             nombreProyectoInput.value = '';
//             // Si no hay datos válidos, limpia el campo en el objeto inscripcion
//             inscripcion.claveProyecto = '';
//             inscripcion.nombreProyecto_n = '';
//         }
//     }).fail(function () {
//         // console.log('Error al obtener la relación del proyecto.');
//     });
// });

