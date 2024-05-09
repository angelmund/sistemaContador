import { alertaInfo, confirmarInfo } from './alertas';

var dt; // Variable global para almacenar la instancia de DataTables

if ($('#example').length > 0) {
    $(".fechaDivs").hide();
    $(".folioDivs").hide();

    function cargarDatos() {
        dt = $('#example').DataTable({
            language: {
                sProcessing: 'Procesando...',
                //remove: sLengthMenu,
                sLengthMenu: 'Mostrar _MENU_ ',
                sZeroRecords: 'No se encontraron resultados que coincidan con lo que escribió',
                sEmptyTable: 'Ningún dato disponible en esta tabla',
                sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                sInfoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
                sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
                sInfoPostFix: '',
                sSearch: 'Buscar:',
                sUrl: '',
                sInfoThousands: ',',
                sLoadingRecords: 'Cargando...',
                oPaginate: {
                    sFirst: 'Primero',
                    sLast: 'Último',
                    sNext: 'Siguiente',
                    sPrevious: 'Anterior'
                },
                oAria: {
                    sSortAscending: ': Activar para ordenar la columna de manera ascendente',
                    sSortDescending: ': Activar para ordenar la columna de manera descendente'
                },
                paginate: {
                    //remove previous & next text from pagination
                    previous: 'Anterior',
                    next: 'Siguiente'
                }
            },
            sProcessing: true,
            //alinea los botones de excel, pdf y print
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    extend: 'csv',
                    className: 'btn btn-success',
                    text: '<i class="fas fa-file-excel"></i>',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    text: '<i class="fas fa-file-pdf"></i>',
                    titleAttr: 'Exportar a PDF'
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    text: '<i class="fas fa-print"></i>',
                    titleAttr: 'Imprimir'
                },
            ],
            responsive: true,
            autoWidth: false
        });

        // // Inicializar el rango de fechas con flatpickr
        // flatpickr("#fechaIncio, #fechaFinal", {
        //     dateFormat: "d/m/Y",
        //     allowInput: true,
        // });

        // Agrega un evento change al select
        $(".status_id").on("change", function () {
            // Obtén el valor seleccionado
            var tipoBusqueda = $(this).val();

            // Oculta todos los divs por defecto
            $(".fechaDivs").hide();
            $(".folioDivs").hide();

            // Muestra u oculta los divs según la opción seleccionada
            if (tipoBusqueda === "Fecha") {


                $(".fechaDivs").show();
            }
            if (tipoBusqueda === "Folio") {

                $(".folioDivs").show();
            }

        });

        // Manejar el evento de clic en el botón de filtrar
        $("#filtrar").on("click", function () {
            var fechaInicio = $("#fechaIncio").val();
            var fechaFinal = $("#fechaFinal").val();
            console.log(fechaInicio, fechaFinal);
            var tipoBusqueda = $(".status_id").val();
            var folioI = $("#folioI").val();
            var folioF = $("#folioF").val();

            if (tipoBusqueda === "seleccione") {
                $(".fechaDivs").hide();
                alertaInfo('Seleccione una opción para hacer una búsqueda')
            }

            // Filtrar la tabla según el tipo de búsqueda
            if (tipoBusqueda === "Fecha") {
                if (fechaInicio === '' || fechaFinal === '') {
                    alertaInfo('Debe seleccionar una fecha inicio y fin');
                } else {
                    // Eliminar la búsqueda anterior
                    $.fn.dataTable.ext.search.pop();

                    // Agregar la nueva búsqueda por rango de fechas
                    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                        var fechaRegistro = moment(data[5], 'DD/MM/YYYY'); // Convertir la fecha de la tabla a un objeto moment

                        if (fechaRegistro.isValid()) { // Verificar si la fecha es válida
                            return fechaRegistro.isSameOrAfter(fechaInicio, 'day') && fechaRegistro.isSameOrBefore(fechaFinal, 'day');
                        } else {
                            return true; // Si la fecha no es válida, mostrar todos los registros
                        }
                    });
                    // Volver a dibujar la tabla con el nuevo filtro
                    dt.draw();
                }
            } else if (tipoBusqueda === "Inscripcion") {
                // Agregar lógica para otros tipos de búsqueda si es necesario
            } else if (tipoBusqueda === "Folio") {
                if (folioI === '' || folioF === '') {
                    alertaInfo('Ingrese un folio de inicio y fin');
                } else {
                    // Eliminar la búsqueda anterior
                    $.fn.dataTable.ext.search.pop();

                    // Agregar la nueva búsqueda por rango de folio
                    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                        var folio = parseInt(data[0]); // Suponiendo que el folio está en la primera columna

                        if (!isNaN(folio)) { // Verificar si el folio es un número
                            var folioInicio = parseInt(folioI);
                            var folioFin = parseInt(folioF);
                            return folio >= folioInicio && folio <= folioFin;
                        } else {
                            return true; // Si el folio no es un número, mostrar todos los registros
                        }
                    });

                    // Volver a dibujar la tabla con el nuevo filtro
                    dt.draw();
                }
            }
        });

        // Restaurar el filtro cuando se cambia el tipo de búsqueda
        $(".status_id").on("change", function () {
            dt.search('').draw(); // Limpiar el filtro
        });



        // Asignar eventos a los botones
        $('#excelButton').on('click', function () {
            confirmarInfo("¿Quiere descargar el archivo Excel?", function () {
                dt.button('.buttons-csv').trigger();
            });
        });


        $('#pdfButton').on('click', function () {
            confirmarInfo("¿Quiere descargar el archivo Pdf?", function () {
                dt.button('.buttons-pdf').trigger();
            });
        });

        $('#printButton').on('click', function () {
            confirmarInfo("¿Desea imprimir el archivo?", function () {
                dt.button('.buttons-print').trigger();
            });
        });
    }

    cargarDatos();
}


