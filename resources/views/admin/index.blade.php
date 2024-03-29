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
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<x-app-layout>
    <h1 class="text-center mt-2">Tabla de Usuarios</h1>
    <div class="card mt-5">
        <div class="card-body">
            <div class="text-center mb-3">
                <input type="hidden" value="{{ url('/') }}" id="url">
                <a href="{{route('usuarios.create')}}" type="button" class="btn btn-primary"><i class='bx bx-user-plus'></i> Nuevo Usuario</a>
                <a type="button" href="{{route('usuarios.roles.index')}}" class="btn btn-warning"><i class='bx bxs-user-check'></i>
                    Nuevo Rol</a>
                {{--  <button id="excelButton" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar a
                    Excel</button>
                <button id="pdfButton" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Exportar a PDF</button>
                <button id="printButton" class="btn btn-info"><i class="fas fa-print"></i> Imprimir</button>  --}}
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
                    <button id="filtrar" class="btn btn-danger"><i class="fas fa-filter"></i> Filtrar</button>
                </div>
            </div>  --}}


            <table id="example" class="table table-striped responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="centrar">#</th>
                        <th class="centrar">Nombre</th>
                        <th class="centrar">Correo</th>
                        <th class="centrar">Rol</th>
                        <th class="centrar">Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>
                            @foreach($usuario->roles as $rol)
                                <span class="badge rounded-pill"
                                    style="background-color: {{ $rol->name == 'Administrador' ? 'green' : 'purple' }}; color: white;">
                                    {{ $rol->name }}
                                </span>
                            @endforeach
                        </td>
                        
                        <td>
                            <span class="badge rounded-pill"
                                style="background-color: {{ $usuario->estado == 1 ? 'green' : 'red' }}; color: white;">
                                {{ $usuario->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{route('usuario.RolAsignado.show', $usuario->id)}}" type="button" class="btn btn-primary"><i
                                    class="fas fa-pen"></i></a>
                            <button type="button" id="btn_delete" class="btn btn-danger eliminar-user" data-target="#DeleteModal"
                                data-toggle="modal" data-id="{{ $usuario->id}}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    {{--  @include('incripciones.edit')
                    @yield('pagos.altaPagos')  --}}
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