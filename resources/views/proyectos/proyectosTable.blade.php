

<x-app-layout>
    <h1 class="text-center mt-2">Personas Inscritas</h1>
    <div class="card mt-5">
        <div class="card-body">
            <div class="text-center mb-3">
                <button id="excelButton" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar a
                    Excel</button>
            </div>
            <div class="row mb-3 ">
                

                <div class="col-md-1 mt-4">
                    <a href="{{route('proyectos.index')}}" type="button" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>


            <table id="example" class="table table-striped responsive consulta" style="width:100%">
                <thead>
                    <tr>
                        <th class="centrar">Folio</th>
                        <th class="centrar">Nombre</th>
                        <th class="centrar">Total Pago</th>
                        <th class="centrar"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyecto->inscripciones as $inscripcion)
                    <tr>
                        <td>{{ $inscripcion->id }}</td>
                        <td>{{ $inscripcion->nombre_completo }}</td>
                        <td>${{ number_format($inscripcion->totalPagos, 0, '.', ',') }}</td>
                        <td>
                            <button type="button" class="btn btn-primary abrir-inscripcion" data-bs-toggle="modal"
                                data-bs-target="#EditInscripcion" data-bs-backdrop="false"
                                data-remote="{{ route('inscripciones.edit', $inscripcion->id) }}"
                                data-id="{{ $inscripcion->id }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="{{route('personaPagos.inscripcion', $inscripcion->id)}}" type="button" class="btn btn-success"><i class="fas fa-dollar-sign"></i></a>

                            @can('Eliminar')
                            <button type="button" id="btn_delete" class="btn btn-danger eliminar-inscripcion"
                                data-target="#DeleteModal" data-toggle="modal" data-id="{{ $inscripcion->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endcan
                        </td>
                    </tr>
                    {{--  @include('incripciones.edit', ['modalId' => $inscripcion->id])  --}}
                    @include('incripciones.edit')
                    @endforeach
                </tbody>
            </table>


        </div>
        
    </div>


</x-app-layout>