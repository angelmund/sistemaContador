
<x-app-layout>
    <h1 class="text-center mt-2">Tabla de Proyectos</h1>
    <div class="card mt-5">
        <div class="card-body">
            <input type="hidden" value="{{ url('/') }}" id="url">
            <div class="text-center mb-3">
                <a href="{{route('proyectos.create')}}" type="button" class="btn btn-primary"><i class='fas fa-plus'></i> Agregar proyecto</a>
                <a href="{{route('inscripciones.form')}}" type="button" class="btn btn-primary"><i class='fas fa-plus'></i> Nueva inscripci&oacute;n</a>
                <h1>Total Presupuesto:$ {{ number_format($totalPresupuesto, 0, '.', ',') }}</h1>
                <h2>Total acumado: ${{number_format($mostrarTotal, 0,'.',',')}}</h2>

                <button id="excelButton" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar a
                    Excel</button>
                <button id="pdfButton" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Exportar a PDF</button>
                <button id="printButton" class="btn btn-info"><i class="fas fa-print"></i> Imprimir</button>
            </div>
            {{--  <div class="row mb-3 ">
                <div class="col-md-4 fechaDivs">
                    <label for="fechainicio">Fecha Inicio</label>
                    <input type="text" id="fechaIncio" name="fechaInicio" class="form-control fechaInicio" readonly />
                </div>

                <div class="col-md-4 fechaDivs">
                    <label for="fechafinal">Fecha Final</label>
                    <input type="text" name="fechaFinal" id="fechaFinal" class="form-control fechaFinal" readonly />
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
                    <button id="filtrar" class="btn btn-danger filtrar"><i class="fas fa-filter"></i> Filtrar</button>
                </div>
            </div>  --}}


            <table id="example" class="table table-striped responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="centrar">Clave</th>
                        <th class="centrar">Nombre</th>
                        <th class="centrar">Encargado</th>
                        <th class="centrar">Presupuesto</th>
                        <th class="centrar">Acumulado</th>
                        <th class="centrar">Num.Inscritos</th>

                        <th class="centrar">Estado</th>
                        <th class="centrar">
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectos as $proyecto)
                    <tr>
                        <td>{{$proyecto->clave_proyecto}}</td>
                        <td>{{$proyecto->nombre}}</td>
                        <td>{{$proyecto->encargado}}</td>
                        <td>${{ number_format($proyecto->presupuesto, 0, '.', ',') }}</td>
                        <td> <span>$ {{ number_format($proyecto->pagos->sum('monto') - $proyecto->cheques->sum('monto'), 0, '.', ',') }}</span> </td>
                        <td>{{ $proyecto->inscripciones->count() }}</td>
                        <td>
                            <span class="badge rounded-pill"
                                style="background-color: {{ $proyecto->estado == 1 ? 'green' : 'red' }}; color: white;">
                                {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>

                        <td>
                            {{--  <button type="button" class="btn btn-warning"><i class="fas fa-download"></i></button>  --}}
                            <button type="button" id="editButton" class="btn btn-primary abrir-proyecto"
                                data-bs-toggle="modal" data-bs-target="#editModal"
                                data-remote="{{route('proyectos.edit',$proyecto->id)}}" data-id="{{$proyecto->id}}"><i
                                    class="fas fa-eye"></i></button>
                            {{--  <button type="button" class="btn btn-success"><i class="fas fa-dollar-sign"></i></button>  --}}

                            @can('Eliminar')
                            <button type="button" id="btn_delete" class="btn btn-danger eliminar"
                                data-target="#DeleteModal" data-toggle="modal" data-id="{{$proyecto->id}}">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endcan

                            <a type="button" href="{{ route('proyectos.tableProyectos', $proyecto->id) }}"
                                class="btn btn-info">
                                <i class="fas fa-table"></i>Inscritos a {{$proyecto->clave_proyecto}}
                            </a>


                        </td>
                    </tr>
                    <!-- Editar Modal -->
                    @include('proyectos.edit', ['proyecto' => $proyecto, 'table' => 'table'.$proyecto->id])
                    {{-- @include('proyectos.proyectosTable', ['proyecto' => $proyecto, 'table' =>
                    'table'.$proyecto->id]) --}}

                    @endforeach

                </tbody>

            </table>
        </div>
        {{-- @include('proyectos.edit'); --}}
    </div>

    
</x-app-layout>