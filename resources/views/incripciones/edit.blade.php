@foreach ($inscripciones as $inscripcion)
 <div class="modal fade edit-modal modal-custom" id="EditModal{{$inscripcion->id}}" tabindex="-1" role="dialog"
        aria-labelledby="miModalLabel" aria-hidden="true" data-bs-backdrop="static">

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
                <form id="formedit-incripcion" action="#" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="{{ $inscripcion->id }}" class="idInscripcion" id="idInscripcion">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo:</label>
                        <input type="text" class="form-control mayuscula" value="{{$inscripcion->nombre_completo}}"
                            id="nombre" name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" class="form-control" id="direccion" value="{{$inscripcion->direccion}}"
                            name="direccion">
                    </div>
                    <div class="mb-3">
                        <label for="claveProyecto" class="form-label">Clave Proyecto:</label>
                        <select name="claveProyecto" id="claveProyecto" class="form-select select2">
                            @foreach ($selectclaveproyecto as $id => $clave_proyecto)
                                <option value="{{ $id }}" {{ $id == optional($inscripcion)->clave_proyecto ? 'selected' : '' }}>{{ $clave_proyecto }}</option>
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="mb-3">
                        <label for="nombreProyecto_n" class="form-label">Nombre Proyecto:</label>
                        <input type="text" class="form-control" id="nombreProyecto_n"
                            value="{{optional($inscripcion->proyecto)->nombre ?? 'No Asignado'}}"
                            name="nombreProyecto_n" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="comite" class="form-label">Comité:</label>
                        <input type="text" class="form-control" id="comite" name="comite"
                            value="{{$inscripcion->comite}}">
                    </div>
                    <div class="mb-3">
                        <label for="alcaldia" class="form-label">Alcaldia:</label>
                        <input type="text" class="form-control" id="alcaldia" value="{{$inscripcion->alcaldia}}"
                            name="alcaldia">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" value="{{$inscripcion->telefono}}"
                            name="telefono">
                    </div>
                    <div class="mb-3">
                        <label for="concepto" class="form-label">Concepto:</label>
                        <input type="text" class="form-control" id="concepto" value="{{$inscripcion->concepto}}"
                            name="concepto" value="Inscripción">
                    </div>
                    <div class="mb-3">
                        <label for="importeInscripcion" class="form-label">Importe Inscripción:</label>
                        <input type="text" class="form-control" id="importeInscripcion" name="importeInscripcion"
                            pattern="[0-9]+" value="{{$inscripcion->importe}}" title="Ingresa solo números"
                            value="1000">
                    </div>
                    <div class="mb-3">
                        <label for="noSolicitud" class="form-label">Número solicitud Ingreso:</label>
                        <input type="text" class="form-control" id="noSolicitud" name="noSolicitud"
                            value="{{$inscripcion->numero_solicitud }}">
                    </div>
                    <div class="mb-3">
                        <label for="fechaDeposito" class="form-label">Fecha de Depósito:</label>
                        <input type="date" class="form-control" id="fechaDeposito" name="fechaDeposito"
                            value="{{ \Carbon\Carbon::parse($inscripcion->fecha_deposito)->format('Y-m-d') }}">
                    </div>


                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones:</label>
                        <textarea type="text" class="form-control" id="observaciones" name="observaciones" required>
                                {{$inscripcion->observaciones}}
                            </textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn_actualizar" id="btn_actualizar"><i
                                class="fas fa-save btn_save"></i> Actualizar
                            inscripción</button>
                        <button type="button" class="btn btn-danger ms-2" id="limpiar" data-bs-dismiss="modal"><i
                                class="fas fa-close"></i> Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
