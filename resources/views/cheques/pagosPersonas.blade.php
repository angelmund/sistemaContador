

<x-app-layout>
    <h1 class="text-center mt-2">Lista de pagos y cheques</h1>
    <h2 class="text-center mt-2">{{$inscripcion->nombre_completo}}</h2>
    <div class="card mt-5">
        <input type="hidden" value="{{ url('/') }}" id="url">
        <div class="card-body">
            <div class="text-center mb-3">
                <button id="excelButton" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar a
                    Excel</button>
                {{-- <button id="pdfButton" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Exportar a
                    PDF</button> --}}
                <button id="printButton" class="btn btn-info"><i class="fas fa-print"></i> Imprimir</button>

                <h2>Total de cheques: {{ $numCheques }}</h2>
                <h2>Total de Pagos: {{ $numPagos }}</h2>
                <h2>Total acumulado: ${{$mostrarTotal}}</h2>
            </div>
            <div class="row mb-3 ">
                <div class="col-md-4 fechaDivs">
                    <label for="fechaInicio">Fecha Inicio</label>
                    <input type="date" id="fechaInicio" name="fechaInicio" class="form-control fechaInicio" />
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
                    <button id="filtrar" class="btn btn-danger filtrar"><i class="fas fa-filter"></i> Filtrar</button>
                </div>
            </div>


            <table id="example" class="table table-striped responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="centrar">Folio Pago</th>
                        <th class="centrar">Folio del cliente</th>
                        <th class="centrar">Cliente</th>
                        <th class="centrar">Monto</th>
                        <th class="centrar">Estado</th>
                        <th class="centrar">Fecha del pago</th>
                        <th class="centrar">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($cheques as $cheque)
                    <tr>
                        <td>{{$cheque->id}}</td>
                        <td>{{$inscripcion->id }}</td>
                        <td>{{$inscripcion->nombre_completo}}</td>
                       
                        <td>
                            <span style="color: {{ $cheque->estado == 1 ? 'red' : 'green' }};">
                                @if($cheque->estado == 1)
                                - ${{$cheque->monto}}
                                @else
                                $0
                                @endif
                            </span>
                        </td>
                       
                        <td><span class="badge rounded-pill"
                                style="background-color: {{ $cheque->estado == 1 ? 'green' : 'red' }}; color: white;">
                                {{ $cheque->estado == 1 ? 'Activo' : 'Anulado' }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($cheque->fecha)->format('d/m/Y') }}</td>
                        <td>
                               
                            @can('Eliminar')
                            <button type="button" id="btn_delete" class="btn btn-danger eliminartipoPago"
                                data-id="{{ $cheque->id }}" data-tipo="cheque" data-target="#DeleteModal"
                                data-toggle="modal">
                                <i class="fas fa-ban"></i>Cancelar
                            </button>
                            @endcan
                        </td>

                    </tr>
                    @endforeach


                    @foreach ($pagos as $pago)
                    <tr>
                        <td>{{$pago->id}}</td>
                        <td>{{$inscripcion->id }}</td>
                        <td>{{$inscripcion->nombre_completo}}</td>
                        
                        <td>
                            <span style="color: {{ $pago->estado == 1 ? 'green' : 'blue' }};">
                                @if($pago->estado == 1)
                                ${{$pago->monto}}
                                @else
                                $0
                                @endif
                            </span>
                        </td>
                       
                        <td> <span class="badge rounded-pill"
                                style="background-color: {{ $pago->estado == 1 ? 'green' : 'red' }}; color: white;">
                                {{ $pago->estado == 1 ? 'Activo' : 'Anulado' }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($pago->fecha)->format('d/m/Y') }}</td>
                        <td>
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


</x-app-layout>