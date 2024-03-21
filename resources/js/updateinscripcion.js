import { confirSave, eliminar } from "./alertas";

document.addEventListener('DOMContentLoaded', function () {
    if ($('#formedit-incripcion').length > 0) {
        $('.select2').select2();
        // $('#claveProyecto').select2();
        // Objeto para almacenar los valores originales de los campos del formulario
        var originalValues = {};

        // Al cargar la página, almacenar los valores originales de los campos del formulario
        $('.edit-modal').on('show.bs.modal', function () {
            $(this).find('input').each(function () {
                var fieldName = $(this).attr('name');
                originalValues[fieldName] = $(this).val();
            });
        });

        // Al abrir el modal, rellenar los campos con los valores originales almacenados
        $('.edit-modal').on('show.bs.modal', function () {
            $(this).find('input').each(function () {
                var fieldName = $(this).attr('name');
                $(this).val(originalValues[fieldName]);
            });
        });

        const formulario = document.querySelector('#formedit-incripcion');

        formulario.addEventListener('submit', async function (event) {
            event.preventDefault(); // Evita que el formulario se envíe automáticamente

            if (!formulario.checkValidity()) {
                event.stopPropagation();
                alertaInfo("Faltan datos por completar");
                formulario.classList.add('was-validated'); // Marcar campos inválidos
                return;
            } else {
                confirSave("¿Los datos capturados son correctos?", function () {
                    updateinscripcion();
                });
            }
        });


        // Escucha cambios en el elemento select
        $('#claveProyecto').on('change', function () {
            var claveProyecto = $(this).val(); // Obtener el valor seleccionado del select
            console.log("Entrando a clave_proyecto: " + claveProyecto);

            $.get('/inscripciones/relacion/' + claveProyecto, function (data) {
                if (data && data.clave_proyecto) {
                    // Actualiza el valor del campo en el objeto inscripcion
                    inscripcion.claveProyecto = data.clave_proyecto; // Actualiza la clave del proyecto
                    inscripcion.nombreProyecto = data.nombre_proyecto; // Actualiza el nombre del proyecto

                    var nombresProyectos = '';

                    //  actualizar el valor de nombreProyectoInput si tienes un nombre
                    if (data.nombre_proyecto) {
                        nombresProyectos = data.nombre_proyecto;
                    }
                    nombreProyecto.value = nombresProyectos;

                } else {
                    nombreProyecto.value = '';
                    // Si no hay datos válidos, limpia el campo en el objeto inscripcion
                    inscripcion.claveProyecto = '';
                    inscripcion.nombreProyecto = '';
                }

                comprobarFormulario(); // Asegura que se compruebe el formulario después del cambio
            }).fail(function () {
                // console.log('Error al obtener la relación del proyecto.');
            });
        });



        async function updateinscripcion() {
            const url = $('#url').val();
            const id = $('#idInscripcion').val();
            try {
                const formData = new FormData($('#formedit-incripcion')[0]);
                var nombreProyectoSeleccionado = $('#claveProyecto option:selected').text(); // Obtener el texto de la opción seleccionada
                formData.append('claveProyecto', nombreProyectoSeleccionado); // Agregar el texto al formData
                console.log(nombreProyectoSeleccionado);
                const response = await fetch(url + '/inscripciones/update/' + id, {
                    method: 'POST',
                    mode: 'cors',
                    redirect: 'manual', // Desactiva las redirecciones automáticas
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: formData
                });
                const data = await response.json();
                // console.log(data); // Muestra los datos recibidos en la consola
                if (data.idnotificacion == 1) {
                    Swal.fire({
                        title: "Inscripción realizada con éxito",
                        icon: "success",
                        showConfirmButton: false,  // No mostrar el botón "Ok"
                        timer: 1500,  // Cerrar automáticamente después de 1500 milisegundos (1.5 segundos)
                        timerProgressBar: true  // Mostrar una barra de progreso durante el temporizador
                    });
                    // Espera 1500 milisegundos (1.5 segundos) antes de limpiar el formulario
                    setTimeout(function () {
                        formulario.reset();  // Limpia el formulario
                        window.location.reload();
                        // comprobarFormulario();  // Asegúrate de que el botón esté deshabilitado después de limpiar
                    }, 1500);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Ocurrió un error al guardar!"
                    });
                }
            } catch (error) {
                console.error("Error al procesar la solicitud:", error);
            }
        }
        ///inscripciones/delete/

        const btnEliminar = document.querySelectorAll('.eliminar-inscripcion');

        btnEliminar.forEach(btn => {
            btn.addEventListener('click', eliminarTipoPago);
        });

        function eliminarTipoPago(event) {
            const id = event.target.dataset.id; // Obtener el ID
            // const tipo = event.target.dataset.tipo; // Obtener el tipo (cheque o pago)
            const url = `/inscripciones/delete/${id}`; // Construir la URL con el tipo y el ID

            eliminar("¿Seguro que quiere eliminar la inscripción?", function () {
                console.log(id);
                enviarSolicitudDelete(url); // Llamar a la función que envía la solicitud DELETE
            });
        }

        async function enviarSolicitudDelete(url) {
            try {
                const response = await fetch(url, {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                });

                const data = await response.json();

                if (data.idnotificacion == 1) {
                    Swal.fire({
                        title: "Cancelado con éxito",
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
                        text: "Ocurrió un error al cancelar"
                    });
                }
            } catch (error) {
                console.error('Error en try-catch:', error);
            }
        }
    }
});

