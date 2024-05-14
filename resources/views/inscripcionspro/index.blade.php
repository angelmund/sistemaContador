

<x-app-layout>
    <h1 class="text-center mt-2">Tabla de Proyectos</h1>
    <div class="card mt-5">
        <div class="card-body">
            <div class="text-center mb-3">
                <button id="excelButton" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar a
                    Excel</button>
                <button id="pdfButton" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Exportar a PDF</button>
                <button id="printButton" class="btn btn-info"><i class="fas fa-print"></i> Imprimir</button>
            </div>
            <div class="row mb-3 ">
                <div class="col-md-4 fechaDivs">
                    <label for="fechainicio">Fecha Inicio</label>
                    <input type="text" id="fechaIncio" name="fechaInicio" class="form-control fechaInicio" readonly />
                </div>

                <div class="col-md-4 fechaDivs">
                    <label for="fechafinal">Fecha Final</label>
                    <input type="text" name="fechaFinal"  id="fechaFinal" class="form-control fechaFinal" readonly />
                </div>
                <div class="col-md-2 folioDivs">
                    <label for="folioI">Desde Folio</label>
                    <input type="text" name="folioI"  id="folioI" class="form-control folioI"  />
                </div>
                <div class="col-md-2 folioDivs">
                    <label for="folioF">Hasta Folio</label>
                    <input type="text" name="folioF"  id="folioF" class="form-control folioF"/>
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
                        <th class="centrar">Clave</th>
                        <th class="centrar">Nombre</th>
                        <th class="centrar">Encargado</th>
                        <th class="centrar">Presupuesto</th>
                        <th class="centrar">Acumulado</th>
                        
                        <th class="centrar">Estado</th>
                        <th class="centrar">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#CreateModal">
                                <i class="fas fa-plus"></i> Nuevo
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectos as $proyecto)
                    <tr>
                        <td>{{$proyecto->clave_proyecto}}</td>
                        <td>{{$proyecto->nombre}}</td>
                        <td>{{$proyecto->encargado}}</td>
                        <td>${{$proyecto->presupuesto}}</td>
                        <td> <span>$0</span> </td>
                        
                        <td>
                            <span class="badge rounded-pill" style="background-color: {{ $proyecto->estado == 1 ? 'green' : 'red' }}; color: white;">
                                {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>

                        <td>
                            <button type="button" class="btn btn-warning"><i class="fas fa-download"></i></button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                                data-bs-target="#editModal{{$proyecto->id}}"><i class="fas fa-eye"></i></button>
                            <button type="button" class="btn btn-success"><i class="fas fa-dollar-sign"></i></button>

                            <button type="button" id="btn_delete" class="btn btn-danger eliminar-modal"
                                data-target="#DeleteModal" data-toggle="modal" data-idcategoria="#">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @include('proyectos.edit', ['proyecto' => $proyecto, 'modalId' => 'editModal'.$proyecto->id])
                    @endforeach

                </tbody>

            </table>
        </div>
        @include('proyectos.edit');
    </div>



</x-app-layout>