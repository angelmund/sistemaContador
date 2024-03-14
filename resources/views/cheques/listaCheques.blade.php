<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.js">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<x-app-layout>
    <h1 class="text-center mt-2">Lista de pagos y cheques</h1>
    <div class="card mt-5">
        <input type="hidden" value="{{ url('/') }}" id="url">
        <div class="card-body">
            <div class="text-center mb-3">
                <button id="excelButton" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar a
                    Excel</button>
                {{-- <button id="pdfButton" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Exportar a
                    PDF</button> --}}
                <button id="printButton" class="btn btn-info"><i class="fas fa-print"></i> Imprimir</button>
            </div>
            <div class="row mb-3 ">
                <div class="col-md-4 fechaDivs">
                    <label for="fechainicio">Fecha Inicio</label>
                    <input type="date" id="fechaIncio" name="fechaInicio" class="form-control fechaInicio" />
                </div>

                <div class="col-md-4 fechaDivs">
                    <label for="fechafinal">Fecha Final</label>
                    <input type="date" name="fechaFinal" id="fechaFinal" class="form-control fechaFinal" />
                </div>
                <div class="col-md-2 folioDivs">
                    <label for="folioI">Desde Folio</label>
                    <input type="text" name="folioI" id="folioI" class="form-control folioI" />
                </div>
                <div class="col-md-2 folioDivs">
                    <label for="folioF">Hasta Folio</label>
                    <input type="text" name="folioF" id="folioF" class="form-control folioF" />
                </div>

                <div class="col-md-2 col-sm-6">
                    <label for="Estado">Buscar por:</label>
                    <select name="estatus_id" class="form-control status_id select2">
                        <option value="seleccione">Seleccione una opción</option>
                        <option value="Inscripcion">Buscar inscripción</option>
                        <option value="Fecha">Rango de Fechas</option>
                        <option value="Folio">Folio</option>
                    </select>
                </div>

                <div class="col-md-1 mt-4">
                    <button id="filtrar" class="btn btn-danger"><i class="fas fa-filter"></i> Filtrar</button>
                </div>
            </div>


            <table id="example" class="table table-striped responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="centrar">Folio del cliente</th>
                        <th class="centrar">Cliente</th>
                        <th class="centrar">Fecha del pago</th>
                        <th class="centrar">Monto</th>
                        <th class="centrar">Clave de proyecto</th>
                        <th class="centrar">Nombre de proyecto</th>
                        <th class="centrar">Estado</th>
                        <th class="centrar">Usuario que dio de alta</th>
                        <th class="centrar"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cheques as $cheque)
                    <tr>
                        <td>{{$cheque->inscripcione->id }}</td>
                        <td>{{$cheque->inscripcione->nombre_completo}}</td>
                        <td>{{ \Carbon\Carbon::parse($cheque->fecha)->format('d/m/Y') }}</td>
                        <td>
                            <span style="color: {{ $cheque->estado == 1 ? 'red' : 'green' }};">
                                @if($cheque->estado == 1)
                                - ${{$cheque->monto}}
                                @else
                                ${{$cheque->monto}}
                                @endif
                            </span>
                        </td>
                        <td>{{$cheque->proyecto->clave_proyecto}}</td>
                        <td> {{$cheque->proyecto->nombre}}</td>
                        <td>
                            <span class="badge rounded-pill"
                                style="background-color: {{ $cheque->estado == 1 ? 'green' : 'red' }}; color: white;">
                                {{ $cheque->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>{{$cheque->user->name}}</td>
                        <td>
                            <a type="button" href="{{ route('cheques.persona', ['tipo' => 'cheque', 'id' => $cheque->id]) }}" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Ver pago
                            </a>
                        
                            @can('Eliminar')
                            <button type="button" id="btn_delete" class="btn btn-danger eliminartipoPago"
                                data-id="{{ $cheque->id }}" data-tipo="cheque" data-target="#DeleteModal"
                                data-toggle="modal">
                                <i class="fas fa-ban"></i>Cancelar
                            </button>
                            @endcan
                        </td>
                    </tr>
                    {{-- @include('incripciones.edit', ['modalId' => $cheque->id]) --}}
                    @yield('cheques.altacheques')
                    @endforeach
                    @foreach ($pagos as $pago)
                    <tr>
                        <td>{{$pago->inscripcione->id}}</td>
                        <td>{{$pago->inscripcione->nombre_completo}}</td>
                        <td>{{ \Carbon\Carbon::parse($pago->fecha)->format('d/m/Y') }}</td>
                        <td>
                            <span style="color: {{ $pago->estado == 1 ? 'green' : 'blue' }};">
                                @if($pago->estado == 1)
                                ${{$pago->monto}}
                                @else
                                ${{$pago->monto}}
                                @endif
                            </span>

                        </td>
                        <td>{{$pago->proyecto->clave_proyecto}}</td>
                        <td>{{$pago->proyecto->nombre}}</td>
                        <td>
                            <span class="badge rounded-pill"
                                style="background-color: {{ $pago->estado == 1 ? 'green' : 'red' }}; color: white;">
                                {{ $pago->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>{{$pago->user->name}}</td>
                        <td>
                            <a href="{{ route('cheques.persona', ['tipo' => 'pago', 'id' => $pago->id]) }}" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Ver pago
                            </a>
                            @can('Eliminar')
                            <button type="button" id="btn_delete" class="btn btn-danger eliminartipoPago"
                                data-id="{{ $pago->id }}" data-tipo="pago" data-target="#DeleteModal"
                                data-toggle="modal">
                                <i class="fas fa-ban"></i>Cancelar
                            </button>
                            @endcan
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        {{-- @include('incripciones.edit'); --}}
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js">
    </script>


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</x-app-layout>