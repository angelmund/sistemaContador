

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
                <h1>Total acumulado: ${{number_format($mostrarTotal, 0,'.',',')}}</h1>
                <h2>Num.Pagos: #{{$sumaPagos}}</h2>
                <h2>Num.Cheques: #{{$sumaCheques}}</h2>
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
                        <th class="centrar">N&uacute;mero</th>
                        <th class="centrar">Folio del cliente</th>
                        <th class="centrar">Cliente</th>
                        <th class="centrar">Monto</th>
                        <th class="centrar">Clave de proyecto</th>
                        <th class="centrar">Fecha del pago</th>
                        <th class="centrar">Nombre de proyecto</th>
                        <th class="centrar">Estado</th>
                        <th class="centrar">Usuario que dio de alta</th>
                        <th class="centrar"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cheques as $cheque)
                    <tr>
                        <td>{{$cheque->numero_cheque}}</td>
                        <td>{{$cheque->inscripcione->id }}</td>
                        <td>{{$cheque->inscripcione->nombre_completo}}</td>
                        
                        <td>
                            <span style="color: {{ $cheque->estado == 1 ? 'red' : 'green' }};">
                                @if($cheque->estado == 1)
                                - ${{ number_format($cheque->monto, 0, '.', ',') }}
                                @else
                                $0
                                @endif
                            </span>
                        </td>
                        <td>{{$cheque->proyecto->clave_proyecto ?? 'No aplica'}}</td>
                        <td>{{ \Carbon\Carbon::parse($cheque->fecha)->format('d/m/Y') }}</td>
                        <td> {{$cheque->proyecto->nombre ?? 'No aplica'}}</td>
                        <td>
                            <span class="badge rounded-pill"
                                style="background-color: {{ $cheque->estado == 1 ? 'green' : 'red' }}; color: white;">
                                {{ $cheque->estado == 1 ? 'Activo' : 'Cancelado' }}
                            </span>
                        </td>
                        <td>{{ $cheque->user->name ?? 'Usuario no encontrado' }}</td>
                        <td>
                            <!-- Para los cheques -->
                            <a href="{{ route('pagos.formato', $cheque->id) }}" class="btn btn-warning"><i class="fas fa-download"></i></a>
                            <a href="{{ route('personaPagos.inscripcion', ['id' => $cheque->inscripcione->id]) }}" class="btn btn-success">
                                <i class="fas fa-dollar-sign"></i>
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
                        <td>{{$pago->id}}</td>
                        <td>{{$pago->inscripcione->id}}</td>
                        <td>{{$pago->inscripcione->nombre_completo}}</td>
                        
                        <td>
                            <span style="color: {{ $pago->estado == 1 ? 'green' : 'blue' }};">
                                @if($pago->estado == 1)
                                 ${{ number_format($pago->monto, 0, '.', ',') }}
                                @else
                                $0
                                @endif
                            </span>

                        </td>
                        <td>{{$pago->proyecto->clave_proyecto ?? 'No aplica'}}</td>
                        <td>{{ \Carbon\Carbon::parse($pago->fecha)->format('d/m/Y') }}</td>
                        <td>{{$pago->proyecto->nombre ?? 'No aplica'}}</td>
                        <td>
                            <span class="badge rounded-pill"
                                style="background-color: {{ $pago->estado == 1 ? 'green' : 'red' }}; color: white;">
                                {{ $pago->estado == 1 ? 'Activo' : 'Cancelado ' }}
                            </span>
                        </td>
                        <td>{{ $cheque->user->name ?? 'Usuario no encontrado' }}</td>

                        <td>
                            <a href="{{ route('pagos.formato', $pago->id) }}" class="btn btn-warning"><i class="fas fa-download"></i></a>
                            <a href="{{ route('personaPagos.inscripcion', ['id' => $pago->inscripcione->id]) }}" class="btn btn-success">
                                <i class="fas fa-dollar-sign"></i>
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

    

</x-app-layout>