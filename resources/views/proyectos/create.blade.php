{{--  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />  --}}

<x-app-layout>

    <div class="container">
        <div class="row mt-5">
            <div class="card mt-5 ">
                <div class="card-body ">
                    <h1 class="text-center">Formulario de Proyectos</h1>
                    <input type="hidden" value="{{ url('/') }}" id="url">
                    <form id="form-proyecto" action="#" method="POST" enctype="multipart/form-data" class="bg-Light p-4 rounded">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            @csrf
                            <div class="mb-3">
                                <label for="claveProyecto_new" class="form-label">Clave Proyecto:</label>
                                <input type="text" class="form-control" id="claveProyecto_new" name="claveProyecto_new" value="">
                                
                            </div>
                            <div class="mb-3">
                                <label for="nombre_new" class="form-label">Nombre Completo:</label>
                                <input type="text" class="form-control @error ('nombre_new') border-red-500 @enderror" id="nombre_new" name="nombre_new" value="" >
                                @error('nombre_new')
                                   <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="descripcion_new" class="form-label">Descripción:</label>
                                <input type="text" class="form-control" id="descripcion_new" name="descripcion_new" value="">
                                
                            </div>
                            <div class="mb-3">
                                <label for="nombreEncargado_new" class="form-label">Nombre Encargado:</label>
                                <input type="text" class="form-control" id="nombreEncargado_new" name="nombreEncargado_new" value="">
                                
                            </div>
                            <div class="mb-3">
                                <label for="ubicacion_new" class="form-label">Ubicación:</label>
                                <input type="text" class="form-control" id="ubicacion_new" name="ubicacion_new" value="">
                                
                            </div>
                            <div class="mb-3">
                                <label for="cantParticipantes_new" class="form-label">Cantidad Máxima Participantes:</label>
                                <input type="number" class="form-control" id="cantParticipantes_new" name="cantParticipantes_new" value="1">
                                
                                
                            </div>
                            
                            <div class="mb-3">
                                <label for="presupuestoN" class="form-label">Presupuesto:</label>
                                <input type="text" class="form-control" id="presupuestoN" name="presupuestoN" placeholder="Ingrese números decimales">
                                
                            </div>
                            
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="btn_save"><i class="fas fa-save"></i> Guardar</button>
                                <button type="button" class="btn btn-danger ms-2" id="limpiar" data-bs-dismiss="modal"><i class="fas fa-trash"></i> Limpiar</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Select2 -->
    {{--  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  --}}


</x-app-layout>