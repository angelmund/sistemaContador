import { alertaInfo, confirmarInfo } from './alertas';


// Verifica si hay elementos que requieren DataTables en la página actual
if ($('#example').length > 0) {

    $(document).ready(function () {
        $('.select2').select2();
        // var table = $('#example');
        var dt;
        $(".fechaDivs").hide();
        $(".folioDivs").hide();
        function cargarDatos() {
            dt = $('#example').DataTable({
                language: {
                    sProcessing: 'Procesando...',
                    //remove: sLengthMenu,
                    sLengthMenu: 'Mostrar _MENU_ personas inscritas',
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
    
            // Inicializar el rango de fechas con flatpickr
            flatpickr("#fechaIncio, #fechaFinal", {
                dateFormat: "d/m/Y",
                allowInput: true,
            });
    
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
                if (tipoBusqueda === "Folio"){
    
                    $(".folioDivs").show();
                }
                
            });
    
            
    
    
            // Manejar el evento de clic en el botón de filtrar
            $("#filtrar").on("click", function () {
                // Obtener los valores de las fechas y el tipo de búsqueda
                var fechaInicio = $("#fechaIncio").val();
                var fechaFinal = $("#fechaFinal").val();
                var tipoBusqueda = $(".status_id").val();
                var folioI = $("#folioI").val();
                var folioF = $("#folioF").val();
    
                if (tipoBusqueda === "seleccione") {
                    $(".fechaDivs").hide();
                    alertaInfo('Seleccione una opción para hacer una búsqueda')
                }
    
                // Formatear las fechas al formato esperado por DataTable
                var fechaInicioFormatted = moment(fechaInicio, "d/m/Y").format("Y-m-d");
                var fechaFinalFormatted = moment(fechaFinal, "d/m/Y").format("Y-m-d");
    
                // Filtrar la tabla según el tipo de búsqueda
                if (tipoBusqueda === "Fecha") {
                    
                    if (fechaInicio == '' && fechaFinal == '') {
                        //alertainfo se define en alertas
                        alertaInfo('Debe seleccionar una fecha inicio y fin');
                    } else {
                        // Filtrar por rango de fechas
                        dt.columns(6).search(fechaInicioFormatted + " to " + fechaFinalFormatted).draw();
                    }
    
                } else if (tipoBusqueda === "Inscripcion") {
                    
                    // Agregar lógica para otros tipos de búsqueda si es necesario
                } else if (tipoBusqueda === "Folio") {
                    if (folioI == '' && folioF == '') {
                        //alertainfo se define en alertas
                        alertaInfo('Ingrese un folio de inicio y fin');
                    }
                    
                    // Agregar lógica para otros tipos de búsqueda si es necesario
                }
                
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
    });
}


