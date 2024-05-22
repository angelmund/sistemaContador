<div class="modal fade" id="EditInscripcion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Inscripci&oacute;n</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal -->
                <input type="hidden" value="{{ url('/') }}" id="url">
                <form id="form-editincripcion" action="#" method="POST" enctype="multipart/form-data">
                    {{-- <input type="text" value="{{ $inscripcion->id }}" class="idInscripcion" id="idInscripcion">
                    --}}
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo:</label>
                        <input type="text" class="form-control mayuscula is-invalid" value="" id="nombre" name="nombre"
                            required>
                        <div class="invalid-feedback">
                            Por favor, el nombre completo.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label ">Dirección:</label>
                        <input type="text" class="form-control mayuscula is-invalid" id="direccion" value="" name="direccion" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa una dirección.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="claveProyecto" class="form-label ">Clave Proyecto:</label>
                        <select name="claveProyecto" id="claveProyecto" class="form-select select2">
                            <!-- Las opciones se llenarán dinámicamente mediante JavaScript -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nombreProyecto_n" class="form-label">Nombre Proyecto:</label>
                        <input type="text" class="form-control" id="nombreProyecto_n" value="" name="nombreProyecto_n"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="comite" class="form-label ">Comité:</label>
                        <input type="text" class="form-control mayuscula is-invalid" id="comite" name="comite" value="" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa una comité.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alcaldia" class="form-label">Alcaldia:</label>
                        <input type="text" class="form-control mayuscula is-invalid" id="alcaldia" value="" name="alcaldia" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa una Alcaldia.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" class="form-control mayuscula is-invalid" id="telefono" value="" name="telefono" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa una Teléfono.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="concepto" class="form-label">Concepto:</label>
                        <input type="text" class="form-control mayuscula is-invalid" id="concepto" value="" name="concepto"
                            value="Inscripción" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa una Concepto.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="importeInscripcion" class="form-label">Importe
                            Inscripción:</label>
                        <input type="text" class="form-control mayuscula is-invalid" id="importeInscripcion" name="importeInscripcion"
                            pattern="[0-9]+" value="" title="Ingresa solo números" value="1000" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa el Importe de Inscripción.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="noSolicitud" class="form-label">Número solicitud
                            Ingreso:</label>
                        <input type="text" class="form-control mayuscula is-invalid" id="noSolicitud" name="noSolicitud" value="" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa el Número de solicitud.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fechaDeposito" class="form-label">Fecha de Depósito:</label>
                        <input type="date" class="form-control mayuscula is-invalid" id="fechaDeposito" name="fechaDeposito" value=""
                            required>
                        <div class="invalid-feedback">
                            Por favor, ingresa la Fecha de Depósito.
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones:</label>
                        <textarea type="text" class="form-control" id="observaciones" name="observaciones" required>

                        </textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn_actualizar"><i
                                class="fas fa-save btn_save"></i> Actualizar inscripción</button>

                        <button type="button" class="btn btn-danger ms-2" id="limpiar" data-bs-dismiss="modal"><i
                                class="fas fa-close"></i> Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>