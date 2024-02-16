<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="modal fade" id="EditModal{{ $inscripcion->id}}" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="miModalLabel">Editar Inscripción</h5>
                <button type="button" class="btn-close" id="btn-grad" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal -->
                <input type="hidden" value="{{ url('/') }}" id="url">
                {{--  @dump($errors->all())  --}}
                <form id="formedit-incripcion" action="{{route('inscripciones.actualizar', $inscripcion->id)}}" method="POST"
                    entype="multipart/form-data">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    <input type="hidden" value="{{$inscripcion->id}}" id="idInscripcion">
                    <div class="mb-3">
                        <label for="nombre_folio_edit" class="form-label">Folio</label>
                        <input type="text" class="form-control  @error ('nombre_folio_edit') border-red-500 @enderror" id="nombre_folio_edit" name="nombre_folio_edit"
                            value="{{$inscripcion->id}}" readonly>
                         @error('nombre_folio_edit')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nombre_edit" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control  @error ('nombre_edit') border-red-500 @enderror" id="nombre_edit" name="nombre_edit"
                            value="{{$inscripcion->nombre_completo}}">
                        @error('nombre_edit')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="direccion_edit" class="form-label">Dirección</label>
                        <input type="text" class="form-control  @error ('direccion_edit') border-red-500 @enderror" id="direccion_edit" name="direccion_edit"
                           value="{{$inscripcion->direccion}}">
                        @error('direccion_edit')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="claveProyecto_edit" class="form-label">Clave Proyecto</label>
                    
                        <select name="claveProyecto_edit" id="claveProyecto_edit" class="form-select select2 @error ('claveProyecto_edit') border-red-500 @enderror">
                            @foreach ($selectclaveproyecto as $id => $clave_proyecto)
                                <option value="{{ $id }}">{{ $clave_proyecto }}</option>
                                @endforeach
                        </select>
                        <input type="hidden" id="nombreProyectoSeleccionado" name="nombreProyectoSeleccionado">

                        @error('claveProyecto_edit')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                     @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="nombreProyecto_edit" class="form-label">Nombre Proyecto</label>
                        <input type="text" class="form-control  @error ('nombreProyecto_edit') border-red-500 @enderror" id="nombreProyecto_edit" name="nombreProyecto_edit"
                            value="{{$inscripcion->proyecto->nombre}}" readonly>
                            @error('nombreProyecto_edit')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="comite_edit" class="form-label">Comité</label>
                        <input type="text" class="form-control  @error ('comite_edit') border-red-500 @enderror" id="comite_edit" name="comite_edit"
                            value="{{$inscripcion->comite}}">
                            @error('comite_edit')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alcaldia_edit" class="form-label">Alcaldia</label>
                        <input type="text" class="form-control  @error ('alcaldia_edit') border-red-500 @enderror" id="alcaldia_edit" name="alcaldia_edit"
                           value="{{$inscripcion->alcaldia}}">
                            @error('alcaldia_edit')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="telefono_edit" class="form-label">Teléfono</label>
                        <input type="text" class="form-control  @error ('telefono_edit') border-red-500 @enderror" id="telefono_edit" name="telefono_edit"
                            value="{{$inscripcion->telefono}}">
                            @error('telefono_edit')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="concepto_edit" class="form-label">Concepto</label>
                        <input type="text" class="form-control  @error ('concepto_edit') border-red-500 @enderror" id="concepto_edit" name="concepto_edit"
                            value="{{$inscripcion->concepto}}">
                            @error('concepto_edit')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="importeInscripcion_edit" class="form-label">Importe Inscripción</label>
                        <input type="text" class="form-control  @error ('importeInscripcion_edit') border-red-500 @enderror" id="importeInscripcion_edit"
                            name="importeInscripcion_edit" value="{{$inscripcion->importe}}">
                            @error('importeInscripcion_edit')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="noSolicitud_edit" class="form-label">Número solicitud Ingreso</label>
                        <input type="text" class="form-control  @error ('noSolicitud_edit') border-red-500 @enderror" id="noSolicitud_edit" name="noSolicitud_edit"
                           value="{{$inscripcion->numero_solicitud}}">
                            @error('noSolicitud_edit')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fechaDeposito_edit" class="form-label">Fecha de Depósito</label>
                        <input type="date" class="form-control  @error ('fechaDeposito_edit') border-red-500 @enderror" id="fechaDeposito_edit" name="fechaDeposito_edit"
                            value="{{date("Y/m/d", strtotime($inscripcion->fecha_deposito))}}">
                            @error('fechaDeposito_edit')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p> 
                         @enderror
                    </div>
                    <!-- Muestra la imagen del cliente si existe -->
                    @if ($inscripcion->url_foto_cliente)
                    <div class="mb-3">
                        <label for="imagen_foto_cliente" class="form-label">Foto del Cliente</label>
                        <img src="{{ asset('storage/' . $inscripcion->url_foto_cliente) }}" id="imagen_foto_cliente"
                            width="300px" height="700px" alt="Foto del cliente">
                    </div>
                    @endif


                    <div class="mb-3">
                        <label for="fotoCliente_edit" class="form-label">Foto del Cliente</label>
                        <input type="file" class="form-control" id="fotoCliente_edit" name="fotoCliente_edit" value="">
                    </div>
                    @if ($inscripcion->url_foto_ine)
                    <div class="mb-3">
                        <label for="imagen_foto_cliente" class="form-label">INE</label>
                        <img src="{{ asset('storage/' . $inscripcion->url_foto_ine) }}" id="imagen_foto_cliente"
                            width="300px" height="700px" alt="Foto del cliente">
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="Ine_edit" class="form-label">Foto del Cliente</label>
                        <input type="file" class="form-control" id="Ine_edit" name="Ine_edit" value="">
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class="btn btn-primary"  id="btn_update"><i
                                class="fas fa-save"></i>Actualizar</button>
                        <button type="button" class="btn btn-danger ms-2" id="btn_cerrar" data-bs-dismiss="modal"><i
                                class="fas fa-close"></i>Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

