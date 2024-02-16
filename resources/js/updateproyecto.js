import { confirSave, eliminar } from "./alertas";

let formularioValido = false;
// Verifica si hay elementos que requieren form-proyecto en la página actual
if ($('#formedit-proyecto').length > 0) {
    document.addEventListener('DOMContentLoaded', function () {
       
        //se crea un objeto con los id de los input para mapear los valores
        const proyecto = {
            //tienen que coicidir con el mismo id de cada campo
            claveProyecto_edit: '',
            nombreProyecto_edit: '',
            descripcion_new: '',
            encargado_edit: '',
            ubicacion_edit: '',
            cantMaxParticipantes_edit: '',
            presupuesto_edit: '',

        };
       


        //se obtienen los id de cada input 
        const claveProyecto = document.querySelector('#claveProyecto_edit');
        const nombreEdit = document.querySelector('#nombreProyecto_edit');
        const descripcionNew = document.querySelector('#descripcion_new');
        const nombreEncargadoEdit = document.querySelector('#encargado_edit');
        const ubicacionEdit = document.querySelector('#ubicacion_edit');
        const cantParticipantesEdit = document.querySelector('#cantMaxParticipantes_edit');
        const presupuestoEdit = document.querySelector('#presupuesto_edit');

        const formulario = document.querySelector('#formedit-proyecto');
        const btnSubmit = document.querySelector('#btn_update');
        const btnCancelar = document.querySelector('#btn_cerrar');
        const btnEquis = document.querySelector('.btn-close');
        const btnabrirModal = document.querySelectorAll('.abrir-modal');
        const btnEliminar =  document.querySelectorAll('.eliminar-modal');

        // Deshabilitar el botón de submit al inicio
        // btnSubmit.disabled = true;
        // btnSubmit.disabled = true;


        // agrega validarformulario
        claveProyecto.addEventListener('input', validarFormulario);
        nombreEdit.addEventListener('input', validarFormulario);
        nombreEncargadoEdit.addEventListener('input', validarFormulario);
        ubicacionEdit.addEventListener('input', validarFormulario);
        cantParticipantesEdit.addEventListener('input', validarFormulario);
        presupuestoEdit.addEventListener('input', validarFormulario);


        btnCancelar.addEventListener('click', (e) => {
            e.preventDefault();

            limpiarAlerta(claveProyecto.parentElement);
            limpiarAlerta(nombreEdit.parentElement);
            // limpiarAlerta(descripcionNew.parentElement);
            limpiarAlerta(nombreEncargadoEdit.parentElement);
            limpiarAlerta(ubicacionEdit.parentElement);
            limpiarAlerta(cantParticipantesEdit.parentElement);
            limpiarAlerta(presupuestoEdit.parentElement);
            comprobarFormulario();
        });

        // valida el formulario
        function validarFormulario() {
            formularioValido = true; // Inicializa en true antes de las validaciones

            // Validar cada campo
            if (claveProyecto.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', claveProyecto.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(claveProyecto.parentElement);
            }

            if (nombreEdit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', nombreEdit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(nombreEdit.parentElement);
            }

            if (nombreEncargadoEdit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', nombreEncargadoEdit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(nombreEncargadoEdit.parentElement);
            }

            if (ubicacionEdit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', ubicacionEdit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(ubicacionEdit.parentElement);
            }

            if (cantParticipantesEdit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', cantParticipantesEdit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(cantParticipantesEdit.parentElement);
            }

            if (presupuestoEdit.value.trim() === '') {
                mostrarAlerta('El campo es obligatorio', presupuestoEdit.parentElement);
                formularioValido = false;
            } else {
                limpiarAlerta(presupuestoEdit.parentElement);
            }

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
            if (alerta) {
                alerta.remove();
            }
        }

        presupuestoEdit.addEventListener('input', function (e) {
            // Obtener el valor actual del campo
            let valor = e.target.value;

            // Quitar cualquier coma existente
            valor = valor.replace(/,/g, '');

            // Formatear el número con comas cada 3 dígitos
            valor = Number(valor).toLocaleString();

            // Actualizar el valor del campo
            e.target.value = valor;
            //console.log("Agregaste:" + valor);

            // Validar el formulario después de formatear
            validarFormulario();
        });


        // Agregar el evento input para la validación
        cantParticipantesEdit.addEventListener('input', function (e) {
            // Obtener el valor del campo y asegurarse de que sea un número
            let valor = parseInt(e.target.value, 10);

            // Si no es un número válido o es menor que 1, establecer el valor a 1
            if (isNaN(valor) || valor < 1) {
                e.target.value = '';
            }
        });

        function comprobarFormulario() {
            // console.log("Comprobando formulario...");

            if (formularioValido) {
                // console.log("Formulario válido");
                btnSubmit.disabled = false;
            } else {
                // console.log("Formulario no válido");
                btnSubmit.disabled = true;
            }
        }


        btnSubmit.addEventListener("click", (e) => {
            e.preventDefault();
            if (formularioValido) { // Verifica si el formulario es válido
                confirSave("¿Los datos capturados, son correctos?", function () {
                    updateproyecto();
                });
            }
        });

        btnabrirModal.forEach(btn => {
            btn.addEventListener('click', consultarproyecto);
            // console.log(consultarproyecto);
        });

        function consultarproyecto(event) {
            const url = event.currentTarget.getAttribute('data-remote');
            // const idproyecto = event.currentTarget.getAttribute('data-remote');
            // const url = '/proyectos/update/' + idproyecto;
            fetch(url)
                .then(respuesta => respuesta.json())
                .then(resultado => {
                    // console.log('Datos recibidos del servidor:', resultado);

                    // Verifica si el modal se abre correctamente
                    $('#editModal').modal('show');

                    // Llenar el modal con los datos obtenidos
                    llenarModal(resultado);
                    validarFormulario(); // Llamar a validarFormulario después de llenar el modal
                })
                .catch(error => console.error('Error:', error));
        }

        function llenarModal(data) {
            // console.log('Datos recibidos para llenar el modal:', data);

            //  selectores en el DOM
            claveProyecto.value = data.clave_proyecto;
            nombreProyecto_edit.value = data.nombre;
            descripcion_edit.value = data.descripcion;
            ubicacion_edit.value = data.ubicacion;
            encargado_edit.value = data.encargado;
            cantMaxParticipantes_edit.value = data.cantMaxParticipantes;
            presupuesto_edit.value = data.presupuesto;

            // ID del registro actual sea correcto
            const idproyecto = data.id;

            // Modificar la acción del formulario para que apunte al ID específico
            const formedit = document.querySelector('#formedit-proyecto');
            formedit.action = '/proyectos/update/' + idproyecto;
        
            //  ID en algún lugar accesible para su posterior uso
            formedit.dataset.proyectoId = idproyecto;

        }
    
        async function updateproyecto() {
            const id = document.querySelector('#formedit-proyecto').dataset.proyectoId;
            const url = $('#url').val();
            try {
                // Elimina las comas del valor de presupuesto antes de enviarlo
                const presupuestoValue = presupuestoEdit.value.replace(/,/g, '');
                // Crea un objeto FormData y agrega los datos
                const formData = new FormData($('#formedit-proyecto')[0]);
                formData.set('presupuestoN', presupuestoValue);
                const response = await fetch(url + '/proyectos/update/' + id, {
                    method: 'POST',
                    mode: 'cors',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: formData
                });
                const data = await response.json();
                // console.log(data); // Muestra los datos recibidos en la consola

                if (data.idnotificacion == 1) {
                    Swal.fire({
                        title: "Proyecto actualizado con éxito",
                        icon: "success",
                        showConfirmButton: false,  // No mostrar el botón "Ok"
                        timer: 1500,  // Cerrar automáticamente después de 1500 milisegundos (1.5 segundos)
                        timerProgressBar: true  // Mostrar una barra de progreso durante el temporizador
                    });
                    // Espera 1500 milisegundos (1.5 segundos) antes de limpiar el formulario
                    setTimeout(function () {
                        formulario.reset();  // Limpia el formulario
                        window.location.reload();
                        // formulario.style.display = 'none';
                        comprobarFormulario();  // Asegurarse que el botón esté deshabilitado después de limpiar
                    }, 1500);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Ocurrió un error al guardar!"
                    });
                }
                // console.log(response);
                // console.log($('#formcreate-medida').serialize());

            } catch (error) {
                // console.log(error);
            }
        }

        btnEliminar.forEach(btn => {
            btn.addEventListener('click', eliminarProyecto);
        });
        
        function eliminarProyecto(event) {
            const id = document.querySelector('#formedit-proyecto').dataset.proyectoId;
            const url = '/categorias/eliminarcategoria/' + id;
    
            eliminar("¿Seguro que quiere eliminar el proyecto?", function (){
                eliminarproyecto();
            })
        }
    
        async function eliminarproyecto(url) {
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
}