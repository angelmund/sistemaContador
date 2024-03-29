<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

    <div class="modal fade edit-modal" id="EditModal{{$inscripcion->id}}" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true" data-bs-backdrop="static">
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
                {{-- @dump($errors->all()) --}}
                <form id="formedit-incripcion" action="{{ route('inscripciones.edit', ['id' => $inscripcion->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    <input type="hidden" value="{{ $inscripcion->id }}" id="idInscripcion">
                    <div class="mb-3">
                        <label for="nombre_folio_edit" class="form-label">Folio</label>
                        <input type="text" class="form-control  @error ('nombre_folio_edit') border-red-500 @enderror"
                            id="nombre_folio_edit" name="nombre_folio_edit" value="{{ $inscripcion->id }}" readonly>
                       
                    </div>
                    <div class="mb-3">
                        <label for="nombre_edit" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control  @error ('nombre_edit') border-red-500 @enderror"
                            id="nombre_edit" name="nombre_edit" value="{{$inscripcion->nombre_completo}}" required>
                        
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Por favor agregue un número de cheque.
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="direccion_edit" class="form-label">Dirección</label>
                        <input type="text" class="form-control  @error ('direccion_edit') border-red-500 @enderror"
                            id="direccion_edit" name="direccion_edit" value="{{$inscripcion->direccion}}" required>
                       
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Por favor agregue un número de cheque.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="claveProyecto_edit" class="form-label">Clave Proyecto</label>
                        <select name="claveProyecto" id="claveProyecto" class="form-select select2">
                            @foreach ($selectclaveproyecto as $id => $clave_proyecto)
                                <option value="{{ $id }}" {{ $inscripcion->clave_proyecto == $id ? 'selected' : '' }}>
                                    {{ $inscripcion->clave_proyecto }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Por favor selecciona un concepto.
                        </div>
                    </div>
                    

                    <div class="mb-3">
                        <label for="nombreProyecto" class="form-label">Nombre Proyecto</label>
                        <input type="text" class="form-control  @error ('nombreProyecto') border-red-500 @enderror"
                            id="nombreProyecto" name="nombreProyecto" value="{{$inscripcion->proyecto->nombre}}"
                            readonly required>
                        
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Por favor agregue un nombre de proyecto.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="comite_edit" class="form-label">Comité</label>
                        <input type="text" class="form-control  @error ('comite_edit') border-red-500 @enderror"
                            id="comite_edit" name="comite_edit" value="{{$inscripcion->comite}}" required>
                       
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Por favor agregue un comit&eacute;.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alcaldia_edit" class="form-label">Alcaldia</label>
                        <input type="text" class="form-control  @error ('alcaldia_edit') border-red-500 @enderror"
                            id="alcaldia_edit" name="alcaldia_edit" value="{{$inscripcion->alcaldia}}" required>
                        
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Por favor agregue una alcald&iacute;a.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="telefono_edit" class="form-label">Teléfono</label>
                        <input type="text" class="form-control  @error ('telefono_edit') border-red-500 @enderror"
                            id="telefono_edit" name="telefono_edit" value="{{$inscripcion->telefono}}" required>
                        
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Por favor ingrese un n&uacute;mero telef&oacute;nico.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="concepto_edit" class="form-label">Concepto</label>
                        <input type="text" class="form-control  @error ('concepto_edit') border-red-500 @enderror"
                            id="concepto_edit" name="concepto_edit" value="{{$inscripcion->concepto}}" required>
                        
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Por favor agregue un concepto.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="importeInscripcion_edit" class="form-label">Importe Inscripción</label>
                        <input type="text"
                            class="form-control  @error ('importeInscripcion_edit') border-red-500 @enderror"
                            id="importeInscripcion_edit" name="importeInscripcion_edit"
                            value="{{$inscripcion->importe}}" required>
                        
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Por favor ingrese el importe.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="noSolicitud_edit" class="form-label">Número solicitud Ingreso</label>
                        <input type="text" class="form-control  @error ('noSolicitud_edit') border-red-500 @enderror"
                            id="noSolicitud_edit" name="noSolicitud_edit" value="{{$inscripcion->numero_solicitud }}"
                            required>
                      
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Por favor ingrese el n&uacute;mero de solicitud.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fechaDeposito_edit" class="form-label">Fecha de Depósito</label>
                        <input type="date" class="form-control @error('fechaDeposito_edit') border-red-500 @enderror"
                            id="fechaDeposito_edit" name="fechaDeposito_edit"
                            value="{{ \Carbon\Carbon::parse($inscripcion->fecha_deposito)->format('Y-m-d') }}">
                        
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Por favor seleccione una fecha.
                        </div>
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
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Actualizar</button>
                        <button type="button" class="btn btn-danger ms-2" id="btn_cerrar" data-bs-dismiss="modal"><i
                                class="fas fa-close"></i>Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>