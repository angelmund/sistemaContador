
<x-app-layout>

    <div class="container">
        <div class="row mt-6">
            <div class="card mt-5 ">
                <div class="card-body ">
                    <h1 class="text-center">Formulario de Inscripción</h1>
                    <input type="hidden" value="{{ url('/') }}" id="url">
                    <form id="form-inscripciones" action="#" method="POST" enctype="multipart/form-data"
                        class="bg-Light p-4 rounded">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo:</label>
                            <input type="text" class="form-control mayuscula" id="nombre" name="nombre" >
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" >
                        </div>
                        <div class="mb-3">
                            <label for="alcaldia" class="form-label">Alcaldia:</label>
                            <input type="text" class="form-control" id="alcaldia" name="alcaldia" >
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" >
                        </div>
                        
                        <div class="mb-3">
                            <label for="comite" class="form-label">Comité:</label>
                            <input type="text" class="form-control" id="comite" name="comite" >
                        </div>
                        <div class="mb-3">
                            <label for="claveProyecto" class="form-label">Clave Proyecto:</label>
                            <select name="claveProyecto" id="claveProyecto" class="form-select select2">
                                <option  selected disabled>Seleccione una opción</option>
                                @foreach ($selectclaveproyecto as $id => $clave_proyecto)
                                <option value="{{ $id }}">{{ $clave_proyecto }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nombreProyecto_n" class="form-label">Nombre Proyecto:</label>
                            <input type="text" class="form-control" id="nombreProyecto_n" name="nombreProyecto_n" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="concepto" class="form-label">Concepto:</label>
                            <input type="text" class="form-control" id="concepto" name="concepto" value="Inscripción">
                        </div>
                        <div class="mb-3">
                            <label for="importeInscripcion" class="form-label">Importe Inscripción:</label>
                            <input type="text" class="form-control" id="importeInscripcion"
                                name="importeInscripcion" pattern="[0-9]+" title="Ingresa solo números" value="1000">
                        </div>
                        <div class="mb-3">
                            <label for="noSolicitud" class="form-label">Número solicitud Ingreso:</label>
                            <input type="text" class="form-control" id="noSolicitud" name="noSolicitud" value="Ninguno">
                        </div>
                        <div class="mb-3">
                            <label for="fechaDeposito" class="form-label">Fecha de Depósito:</label>
                            <input type="date" class="form-control" id="fechaDeposito" name="fechaDeposito"
                                >
                        </div>
                        
                        {{--  <div class="mb-3">
                            <label for="fotoCliente" class="form-label">Foto del Cliente:</label>
                            <input type="file" class="form-control" id="fotoCliente" name="fotoCliente" >
                        </div>
                        <div id="fotocliente" ></div>
                        <div class="mb-3">
                            <label for="Ine" class="form-label">Foto de Identificación (INE):</label>
                            <input type="file" class="form-control" id="Ine" name="Ine" >
                        </div>
                        <div id="fotoIne" ></div>  --}}
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones:</label>
                            <textarea type="text" class="form-control" id="observaciones" name="observaciones" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btn_save"><i
                                    class="fas fa-save"></i> Guardar inscripción</button>
                            <button type="button" class="btn btn-danger ms-2" id="limpiar" data-bs-dismiss="modal"><i
                                    class="fas fa-trash"></i> Limpiar formulario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
</x-app-layout>