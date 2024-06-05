if ($('.consulta').length > 0) {


    // Evento para abrir el modal y cargar los datos
    $('#example').on('click', '.abrir-inscripcion', function (event) {
        event.preventDefault();
        // Obtener la url del botón que ha sido clicado
        var url = $(this).data('remote');
        consultarInscripcion(url);
    });

    // Función para convertir y formatear la fecha en el formato esperado por un input de tipo date
    function formatearFecha(fechaISO) {
        const date = new Date(fechaISO);
        const day = ('0' + date.getDate()).slice(-2);
        const month = ('0' + (date.getMonth() + 1)).slice(-2);
        const year = date.getFullYear();
        return `${year}-${month}-${day}`; // Formato YYYY-MM-DD
    }


    // Función para consultar la inscripción
    function consultarInscripcion(url) {
        fetch(url)
            .then(respuesta => {
                if (!respuesta.ok) {
                    throw new Error('Error');
                }
                return respuesta.json();
            })
            .then(datos => {
                if (datos.error) {
                    console.error('Error:', datos.error);
                    return;
                }
                mostrarDatos(datos);

                // Verifica si el modal se abre correctamente
                $('#EditInscripcion').modal('show');

            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Función para mostrar los datos en el formulario del modal
    function mostrarDatos(datos) {
        //obtener los datos de mi json enviado desde el back
        const inscripcion = datos.inscripcion;
        const selectclaveproyecto = Object.entries(datos.selectclaveproyecto);
        const proyecto = datos.proyecto;

        // Asignar valores a los campos del formulario
        $('#nombre').val(inscripcion.nombre_completo);
        $('#id').val(inscripcion.id);
        $('#direccion').val(inscripcion.direccion);
        $('#comite').val(inscripcion.comite);
        $('#alcaldia').val(inscripcion.alcaldia);
        $('#telefono').val(inscripcion.telefono);
        $('#concepto').val(inscripcion.concepto);
        $('#importeInscripcion').val(inscripcion.importe);
        // Asignar el nombre del proyecto, o una cadena vacía si no hay proyecto
        $('#nombreProyecto_n').val(proyecto ? proyecto.nombre : '');
        $('#noSolicitud').val(inscripcion.numero_solicitud);

        // Convertir y asignar la fecha formateada
        const fechaFormateada = formatearFecha(inscripcion.fecha_deposito);

        $('#fechaDeposito').val(fechaFormateada);

        $('#observaciones').val(inscripcion.observaciones);

        // Llenar el select y seleccionar la clave del proyecto
        const select = document.getElementById('claveProyecto');
        select.innerHTML = ''; // Limpiar opciones existentes
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'No Asignado';
        select.appendChild(defaultOption);

        selectclaveproyecto.forEach(([id, clave]) => {
            const option = document.createElement('option');
            option.value = id;
            option.textContent = clave;
            if (clave === inscripcion.clave_proyecto) {
                option.selected = true;
            }
            select.appendChild(option);
        });



        // console.log(datos);
    }

    var form = document.getElementById('form-editincripcion');

    $('#EditInscripcion').on('shown.bs.modal', function () {
        // Remove validation classes
        $('.mayuscula').removeClass('is-valid is-invalid');

        form.addEventListener('submit', function (event) {
            var inputs = this.getElementsByTagName('input');
            var isValid = true;

            for (var i = 0; i < inputs.length; i++) {
                if (!inputs[i].checkValidity()) {
                    inputs[i].classList.add('is-invalid');
                    isValid = false;
                } else {
                    inputs[i].classList.remove('is-invalid');
                    inputs[i].classList.add('is-valid');
                }
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    });

    $('.mayuscula').on('input', function () {
        var input = $(this);
        var is_name = input.val();
        if (is_name) {
            input.removeClass("is-invalid").addClass("is-valid");
        } else {
            input.removeClass("is-valid").addClass("is-invalid");
        }
    });

    btnSubmit.addEventListener("click", (e) => {
        e.preventDefault();
        if (form.checkValidity()) { // Verifica si el formulario es válido
            confirSave("¿Los datos capturados, son correctos?", function () {
                updateinscripcion();
            });
        }
    });

    async function updateinscripcion() {
        const url = $('#url').val();
        const id = $('#id').val();
        console.log(id);
        try {
            const formData = new FormData($('#form-editincripcion')[0]);
            const claveProyectoValue = $('#claveProyecto').val();
            const claveProyectoText = $('#claveProyecto option:selected').text();
            const claveProyectoFinalValue = claveProyectoText === 'Seleccione una opción' ? '' : claveProyectoText;
            const telefonoValue = $('#telefono').val().replace(/\s/g, '');

            formData.append('claveProyecto', claveProyectoFinalValue);
            formData.append('telefono', telefonoValue);
            console.log(formData);

            const response = await fetch(url + '/inscripciones/update/' + id, {
                method: 'POST',
                mode: 'cors',
                redirect: 'manual',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: formData
            });

            const data = await response.json();
            if (data.idnotificacion == 1) {
                Swal.fire({
                    title: data.mensaje,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                });
                setTimeout(function () {
                    $('#form-editincripcion')[0].reset();
                    window.location.reload();
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
}
