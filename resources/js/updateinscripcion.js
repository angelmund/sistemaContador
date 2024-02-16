import { confirSave, eliminar } from "./alertas";
let formularioValido = true;
if ($('#formedit-incripcion').length > 0) {
    $('.select2').select2();
    $('#claveProyecto_edit').select2();
    document.addEventListener('DOMContentLoaded', function () {
        //se crea un objeto con los id de los input para mapear los valores
        const inscripcion = {
            //tienen que coicidir con el mismo id de cada campo
            nombre_folio_edit: '',
            nombre_edit: '',
            direccion_edit: '',
            claveProyecto_edit: '',
            nombreProyecto_edit: '',
            comite_edit: '',
            alcaldia_edit: '',
            telefono_edit: '',
            concepto_edit: '',
            importeInscripcion_edit: '',
            noSolicitud_edit: '',
            fechaDeposito_edit: '',
            fotoCliente_edit: '',
            Ine_edit: '',
        };



        //se obtienen los id de cada input 
        const nombreFolio = document.querySelector('#nombre_folio_edit');
        const nombreEdit = document.querySelector('#nombre_edit');
        const direccionEdit = document.querySelector('#direccion_edit');
        const claveProyecto_edit = document.querySelector('#claveProyecto_edit');
        const nombreProyecto_edit = document.querySelector('#nombreProyecto_edit');
        const comiteEdit = document.querySelector('#comite_edit');
        const alcaldiaEdit = document.querySelector('#alcaldia_edit');
        const telefonoEdit = document.querySelector('#telefono_edit');
        const conceptoEdit = document.querySelector('#concepto_edit');
        const importeInscripcion_edit = document.querySelector('#importeInscripcion_edit');
        const noSolicitud_edit = document.querySelector('#noSolicitud_edit');
        const fechaDeposito_edit = document.querySelector('#fechaDeposito_edit');
        const fotoCliente_edit = document.querySelector('#fotoCliente_edit');
        const fotoCliente = document.querySelector('#fotocliente');
        const Ine_edit = document.querySelector('#Ine_edit');
       

        const formedit = document.querySelector('#formedit-incripcion');
        const btnUpdate = document.querySelector('#btn_update');
        const btnCancelar = document.querySelector('#btn_cerrar');
        const btnEquis = document.querySelector('.btn-close');
        const btnabrirModal = document.querySelectorAll('.abrir-inscripcion');
        const btnEliminar = document.querySelectorAll('.eliminar-modal');



        // agrega validarformulario
        nombreFolio.addEventListener('input', validarFormulario);
        nombreEdit.addEventListener('input', validarFormulario);
        direccionEdit.addEventListener('input', validarFormulario);
        claveProyecto_edit.addEventListener('input', validarFormulario);
        nombreProyecto_edit.addEventListener('input', validarFormulario);
        // nombreEncargadoEdit.addEventListener('input', validarFormulario);
        // comiteEdit.addEventListener('input', validarFormulario);
        alcaldiaEdit.addEventListener('input', validarFormulario);
        telefonoEdit.addEventListener('input', validarFormulario);
        conceptoEdit.addEventListener('input', validarFormulario);
        importeInscripcion_edit.addEventListener('input', validarFormulario);
        noSolicitud_edit.addEventListener('input', validarFormulario);
        fechaDeposito_edit.addEventListener('input', validarFormulario);
        // fotoCliente_edit.addEventListener('input', validarFormulario);
        // Ine_edit.addEventListener('input', validarFormulario);


        btnCancelar.addEventListener('click', (e) => {
            e.preventDefault();

            limpiarAlerta(nombreFolio.parentElement);
            limpiarAlerta(nombreEdit.parentElement);
            limpiarAlerta(direccionEdit.parentElement);
            limpiarAlerta(claveProyecto_edit.parentElement);
            limpiarAlerta(nombreProyecto_edit.parentElement);
            // limpiarAlerta(descripcionNew.parentElement);
            // limpiarAlerta(nombreEncargadoEdit.parentElement);
            limpiarAlerta(comiteEdit.parentElement);
            limpiarAlerta(alcaldiaEdit.parentElement);
            limpiarAlerta(telefonoEdit.parentElement);
            limpiarAlerta(conceptoEdit.parentElement);
            limpiarAlerta(importeInscripcion_edit.parentElement);
            limpiarAlerta(noSolicitud_edit.parentElement);
            limpiarAlerta(fechaDeposito_edit.parentElement);
            // limpiarAlerta(fotoCliente_edit.parentElement);
            // limpiarAlerta(Ine_edit.parentElement);
            comprobarFormulario();
        });

        btnEquis.addEventListener('click', (e) => {
            e.preventDefault();

            limpiarAlerta(nombreFolio.parentElement);
            limpiarAlerta(nombreEdit.parentElement);
            limpiarAlerta(direccionEdit.parentElement);
            limpiarAlerta(claveProyecto_edit.parentElement);
            limpiarAlerta(nombreProyecto_edit.parentElement);
            // limpiarAlerta(descripcionNew.parentElement);
            // limpiarAlerta(nombreEncargadoEdit.parentElement);
            limpiarAlerta(comiteEdit.parentElement);
            limpiarAlerta(alcaldiaEdit.parentElement);
            limpiarAlerta(telefonoEdit.parentElement);
            limpiarAlerta(conceptoEdit.parentElement);
            limpiarAlerta(importeInscripcion_edit.parentElement);
            limpiarAlerta(noSolicitud_edit.parentElement);
            limpiarAlerta(fechaDeposito_edit.parentElement);
            // limpiarAlerta(fotoCliente_edit.parentElement);
            // limpiarAlerta(Ine_edit.parentElement);
            comprobarFormulario();
        });

        // valida el formulario
        function validarFormulario() {
            formularioValido = true; // Inicializa en true antes de las validaciones

            // Validar cada campo
            if (nombreFolio.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', nombreFolio.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(nombreFolio.parentElement);
            }

            if (nombreEdit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', nombreEdit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(nombreEdit.parentElement);
            }

            if (direccionEdit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', direccionEdit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(direccionEdit.parentElement);
            }

            if (claveProyecto_edit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', claveProyecto_edit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(claveProyecto_edit.parentElement);
            }

            if (nombreProyecto_edit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', nombreProyecto_edit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(nombreProyecto_edit.parentElement);
            }


            if (comiteEdit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', comiteEdit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(comiteEdit.parentElement);
            }
            if (alcaldiaEdit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', alcaldiaEdit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(alcaldiaEdit.parentElement);
            }
            if (telefonoEdit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', telefonoEdit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(telefonoEdit.parentElement);
            }
            if (conceptoEdit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', conceptoEdit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(conceptoEdit.parentElement);
            }
            if (importeInscripcion_edit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', importeInscripcion_edit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(importeInscripcion_edit.parentElement);
            }
            if (noSolicitud_edit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', noSolicitud_edit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(noSolicitud_edit.parentElement);
            }
            if (fechaDeposito_edit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', fechaDeposito_edit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(fechaDeposito_edit.parentElement);
            }
            // if (fotoCliente_edit.value.trim() === '') {
            //     mostrarAlerta('El campo es obligatorio', fotoCliente_edit.parentElement);
            //     formularioValido = false;
            // } else {
            //     limpiarAlerta(fotoCliente_edit.parentElement);
            // }
            // if (Ine_edit.value.trim() === '') {
            //     mostrarAlerta('El campo es obligatorio', Ine_edit.parentElement);
            //     formularioValido = false;
            // } else {
            //     limpiarAlerta(Ine_edit.parentElement);
            // }

            // Actualizar el estado del formulario
            comprobarFormulario();
        }

        // muestra alerta 
        function mostrarAlerta(mensaje, referencia) {
            limpiarAlerta(referencia);

            const error = document.createElement('SPAN');

            error.textContent = mensaje;
            error.classList.add('bg-danger', 'text-white', 'p-2', 'text-center');
            referencia.appendChild(error);
        }

        // limpia la alerta 
        function limpiarAlerta(referencia) {
            const alerta = referencia.querySelector('.bg-danger');
            const alert = document.querySelector('.bg-red-50');
            if (alerta || alert) {
                alerta.remove();
                alert.remove();
            }
        }


        function comprobarFormulario() {
            // console.log("Comprobando formulario...");

            if (formularioValido) {
                // console.log("Formulario válido");
                btnUpdate.disabled = false;
            } else {
                // console.log("Formulario no válido");
                btnUpdate.disabled = true;
            }
        }

        btnUpdate.addEventListener("click", (e) => {
            e.preventDefault();
            if (formularioValido) { // Verifica si el formulario es válido
                confirSave("¿Los datos capturados, son correctos?", function () {
                    updateinscripcion();
                });
            }
        });

        // btnabrirModal.forEach(btn => {
        //     btn.addEventListener('click', consultarInscripcion);

        // });

        
        // function consultarInscripcion(event) {
        //     const idproyecto = document.documentElement('idInscripcion');
        //     const url = event.currentTarget.getAttribute('data-remote') + idproyecto;
            
        //     fetch(url)
        //         .then(respuesta => respuesta.json())
        //         .then(resultado => {
        //             // console.log('Datos recibidos del servidor:', resultado);

        //             // Verifica si el modal se abre correctamente
        //             $('#editModal').modal('show');

        //             // Llenar el modal con los datos obtenidos
        //             llenarModal(resultado);
        //             validarFormulario(); // Llamar a validarFormulario después de llenar el modal
        //         })
        //         .catch(error => console.error('Error:', error));
        // }
        

        // function llenarModal(data) {
        //     console.log('Datos recibidos para llenar el modal:', data);

        //     //  selectores en el DOM
        //     // nombre_folio_Ine_edit
        //     nombreFolio.value = data.id;
        //     nombreEdit.value = data.nombre_completo;
        //     direccionEdit.value = data.direccion;
        //     claveProyecto_edit.value = data.clave_proyecto;
        //     nombreProyecto_edit .value = data.nombre;
        //     comiteEdit.value = data.comite;
        //     alcaldiaEdit.value = data.alcaldia;
        //     telefonoEdit.value = data.telefono;
        //     importeInscripcion_edit.value = data.concepto;
        //     noSolicitud_edit.value = data.numero_solicitud;
        //     fechaDeposito_edit.value = data.fecha_deposito;
        //     // importeInscripcion_edit.value = data.importe;
        //     // comite_edit.value = data.comite;

          
        //     // ID del registro actual sea correcto
        //     const id = data.id;

        //     // Modificar la acción del formulario para que apunte al ID específico
        //     // const formedit = document.querySelector('#formedit-incripcion');
        //     formedit.action = '/inscripciones/update/' + id;

        //     //  ID en algún lugar accesible para su posterior uso
        //     formedit.dataset.proyectoId = id;

        // }

        // Escucha cambios en el elemento select
        $('#claveProyecto_edit').on('change', function () {
            var claveProyecto_edit = document.querySelector('#claveProyecto_edit');
            var nombreProyectoSeleccionado = this.options[this.selectedIndex].text; // Obtiene el texto de la opción seleccionada
            console.log("Has seleccionado: " + nombreProyectoSeleccionado);

            $.get('/inscripciones/relacion/' + claveProyecto_edit, function (data) {
                if (data && data.clave_proyecto) {
                    // Actualiza el valor del campo en el objeto inscripcion
                    inscripcion.claveProyecto_edit = data.clave_proyecto; // Actualiza la clave del proyecto
                    inscripcion.nombreProyecto_edit = data.nombre_proyecto; // Actualiza el nombre del proyecto

                    var nombresProyectos = '';

                    //  actualizar el valor de nombreProyectoInput si tienes un nombre
                    if (data.nombre_proyecto) {
                        nombresProyectos = data.nombre_proyecto;
                    }

                    nombreProyecto_edit.value = nombresProyectos;

                } else {
                    nombreProyecto_edit.value = '';
                    // Si no hay datos válidos, limpia el campo en el objeto inscripcion
                    inscripcion.claveProyecto_edit = '';
                    inscripcion.nombreProyecto_edit = '';
                }

                comprobarFormulario(); // Asegura que se compruebe el formulario después del cambio
            }).fail(function () {
                // console.log('Error al obtener la relación del proyecto.');
            });
        });

        // Cuando se seleccione una opción en el primer label
        // $('#distrito').on('change', function () {
        //     var idSeleccionado = $(this).val();
        //     var selectjuzgados = document.getElementById('juzgado');

        //     // Realiza una solicitud AJAX para obtener las relaciones
        //     $.get('relaciones-distrito/' + idSeleccionado, function (data) {
        //         // Limpia las opciones anteriores del segundo label
        //         $('#juzgado').empty();

        //         // Verifica si se recibieron datos válidos
        //         if (data.length > 0) {
        //             // Agrega una opción por defecto
        //             $('#juzgado').append($('<option>', {
        //                 value: '',
        //                 text: 'Seleccione un juzgado'
        //             }));

        //             // Agrega las relaciones al segundo label
        //             $.each(data, function (index, relacion) {
        //                 $('#juzgado').append($('<option>', {
        //                     value: relacion.idjuzgado,
        //                     text: relacion.juzgado

        //                 }));
        //             });
        //         } else {
        //             // console.log('No se encontraron relaciones.');
        //         }
        //     }).fail(function () {
        //         //console.log('Error al obtener relaciones.');
        //     });
        // });


        
        async function updateinscripcion() {
            const url = $('#url').val();
            const id = $('#idInscripcion').val();
            try {
                const formData = new FormData($('#formedit-incripcion')[0]);
                var claveProyecto = $('#claveProyecto_edit').val(); // Cambio aquí
                var nombreProyectoSeleccionado = $('#claveProyecto_edit option:selected').text(); // Cambio aquí
                // $('#nombreProyectoSeleccionado').val(nombreProyectoSeleccionado); // Establece el valor del campo oculto
                console.log("Has enviado: " + nombreProyectoSeleccionado);
                // Agrega el valor de nombreProyecto al formData eliminar claveProyecto para que  no siga mandando el post y get 
                formData.append('claveProyecto', nombreProyectoSeleccionado);
                console.log(formData);
                const response = await fetch(url + '/inscripciones/update/' + id, {
                    method: 'POST',
                    mode: 'cors',
                    redirect: 'manual',  // Desactiva las redirecciones automáticas
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
        


    });
}