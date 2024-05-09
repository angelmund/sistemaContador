
<x-app-layout>
    <h1 class="text-center mt-2">Tabla de Inscripciones</h1>
    <div class="card mt-5">
        <input type="hidden" value="{{ url('/') }}" id="url">
        <div class="card-body">
            <div class="text-center mb-3">
                <a href="{{route('inscripciones.form')}}" type="button" class="btn btn-primary"><i
                        class="fas fa-plus"></i> Nueva Inscripción</a>
                <button id="excelButton" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar a
                    Excel</button>
                <button id="pdfButton" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Exportar a PDF</button>
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


            <table id="example" class="table table-striped responsive table_inscripcion" style="width:100%">
                <thead>
                    <tr>
                        <th class="centrar">Folio</th>
                        <th class="centrar">Nombre</th>
                        <th class="centrar">Dirección</th>
                        <th class="centrar">Clave Proyecto</th>
                        <th class="centrar">Nombre del Proyecto</th>
                        <th class="centrar">Fecha de registro</th>
                        <th class="centrar">Estado</th>
                        <th class="centrar">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inscripciones as $inscripcion)
                    <tr>
                        <td>{{$inscripcion->id}}</td>
                        <td>{{ optional($inscripcion->proyecto)->encargado ?? 'No Asignado' }}</td>
                        <td>{{ $inscripcion->direccion }}</td>
                        <td>{{ $inscripcion->clave_proyecto ? $inscripcion->clave_proyecto : 'No Asignado' }}</td>
                        <td>{{ optional($inscripcion->proyecto)->nombre ?? 'No Asignado' }}</td>

                        <td>{{ \Carbon\Carbon::parse($inscripcion->fecha_registro)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge rounded-pill"
                                style="background-color: {{ $inscripcion->estado == 1 ? 'green' : 'red' }}; color: white;">
                                {{ $inscripcion->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning"><i class="fas fa-download"></i></button>
                            <button type="button" class="btn btn-primary abrir-inscripcion" data-bs-toggle="modal"
                                data-bs-target="#EditModal{{$inscripcion->id}}" data-bs-backdrop="false"
                                data-id="{{$inscripcion->id}}">
                                <i class="fas fa-eye"></i>
                            </button>



                            <a type="button" href="{{route('pagos.alta', $inscripcion->id)}}" class="btn btn-success"><i
                                    class="fas fa-dollar-sign"></i></a>
                            @can('Eliminar')
                            <button type="button" id="btn_delete" class="btn btn-danger eliminar-inscripcion"
                                data-target="#DeleteModal" data-toggle="modal" data-id="{{ $inscripcion->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endcan
                        </td>
                    </tr>

                    @include('incripciones.edit', ['modalId' => $inscripcion->id])

                    @yield('pagos.altaPagos')
                    @endforeach

                </tbody>

            </table>
        </div>
        {{-- @include('incripciones.edit'); --}}
    </div>



</x-app-layout>