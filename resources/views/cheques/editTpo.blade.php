<!--- Editar ------>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="miModalLabel">Editar Proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal -->
                <input type="hidden" value="{{ url('/') }}" id="url">
                {{-- {{$errors}} --}}
                <form id="formedit-proyecto" action="/proyectos/update" method="POST" enctype="multipart/form-data">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf

                    <div class="mb-3">
                        <label for="claveProyecto_edit" class="form-label">Clave Proyecto:</label>
                        <input type="hidden" id="idproyectos" value="">
                        <input type="text" class="form-control" id="claveProyecto_edit" name="claveProyecto_edit"
                            value="">
                        @error('claveProyecto_edit')
                        <small>
                            <strong>{{$message}}</strong>
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nombreProyecto_edit" class="form-label">Nombre Proyecto:</label>
                        <input type="text" class="form-control" id="nombreProyecto_edit" name="nombreProyecto_edit"
                            value="">
                        @error('nombreProyecto_edit')
                        <small>
                            <strong>{{$message}}</strong>
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="descripcion_edit" class="form-label">Descripción:</label>
                        <input type="text" class="form-control" id="descripcion_edit" name="descripcion_edit" value="">
                        @error('descripcion_edit')
                        <small>
                            <strong>{{$message}}</strong>
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ubicacion_edit" class="form-label">Ubicación:</label>
                        <input type="text" class="form-control" id="ubicacion_edit" name="ubicacion_edit" value="">
                        @error('ubicacion_edit')
                        <small>
                            <strong>{{$message}}</strong>
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="encargado_edit" class="form-label">Encargado:</label>
                        <input type="text" class="form-control" id="encargado_edit" name="encargado_edit" value="">
                        @error('encargado_edit')
                        <small>
                            <strong>{{$message}}</strong>
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="presupuesto_edit" class="form-label">Presupuesto:</label>
                        <input type="text" class="form-control" id="presupuesto_edit" name="presupuesto_edit" value="">
                        @error('presupuesto_edit')
                        <small>
                            <strong>{{$message}}</strong>
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cantMaxParticipantes_edit" class="form-label">Cantidad Máxima de
                            participantes:</label>
                        <input type="text" class="form-control" id="cantMaxParticipantes_edit"
                            name="cantMaxParticipantes_edit" value="">
                        @error('cantMaxParticipantes_edit')
                        <small>
                            <strong>{{$message}}</strong>
                        </small>
                        @enderror
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn_update"><i class="fas fa-save"></i>
                            Actualizar</button>
                        <button type="button" class="btn btn-danger ms-2" id="btn_cerrar" data-bs-dismiss="modal"><i
                                class="fas fa-times"></i>Cerrar</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>