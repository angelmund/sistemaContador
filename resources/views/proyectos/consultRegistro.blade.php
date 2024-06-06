<div class="modal fade" id="VerInscripcion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ver Inscripci&oacute;n</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal -->
                <input type="hidden" value="{{ url('/') }}" id="url">
                <form id="form-consulta" action="#" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="" class="id" id="id">
                  
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo:</label>
                        <input type="text" class="form-control mayuscula is-valid" value="" id="nombre" name="nombre nombre_completo"
                            >
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label ">Dirección:</label>
                        <input type="text" class="form-control mayuscula is-valid" id="direccion" value="" name="direccion" >
                        
                    </div>
                    <div class="mb-3">
                        <label for="claveProyecto" class="form-label is-valid">Clave Proyecto:</label>
                        <select name="claveProyecto" id="claveProyecto" class="form-select is-valid">
                            <!-- Las opciones se llenarán dinámicamente mediante JavaScript -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nombreProyecto_n" class="form-label ">Nombre Proyecto:</label>
                        <input type="text" class="form-control is-valid" id="nombreProyecto_n" value="" name="nombreProyecto_n"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="comite" class="form-label ">Comité:</label>
                        <input type="text" class="form-control mayuscula is-valid" id="comite" name="comite" value="" >
                       
                    </div>
                    <div class="mb-3">
                        <label for="alcaldia" class="form-label">Alcaldia:</label>
                        <input type="text" class="form-control mayuscula is-valid" id="alcaldia" value="" name="alcaldia" >
                        
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" class="form-control mayuscula is-valid" id="telefono" value="" name="telefono" >
                    
                    </div>
                    <div class="mb-3">
                        <label for="concepto" class="form-label">Concepto:</label>
                        <input type="text" class="form-control mayuscula is-valid" id="concepto" value="" name="concepto"
                            value="Inscripción" >
                      
                    </div>
                    <div class="mb-3">
                        <label for="importeInscripcion" class="form-label">Importe
                            Inscripción:</label>
                        <input type="text" class="form-control mayuscula is-valid" id="importeInscripcion" name="importeInscripcion"
                            pattern="[0-9]+" value="" title="Ingresa solo números" value="1000" >
                        
                    </div>
                    <div class="mb-3">
                        <label for="noSolicitud" class="form-label">Número solicitud
                            Ingreso:</label>
                        <input type="text" class="form-control mayuscula is-valid" id="noSolicitud" name="noSolicitud" value="" >
                       
                    </div>
                    <div class="mb-3">
                        <label for="fechaDeposito" class="form-label">Fecha de Depósito:</label>
                        <input type="date" class="form-control mayuscula is-valid" id="fechaDeposito" name="fechaDeposito" value=""
                            >
                     
                    </div>


                    <div class="mb-3">
                        <label for="observaciones" class="form-label ">Observaciones:</label>
                        <textarea type="text" class="form-control is-valid" id="observaciones" name="observaciones" >

                        </textarea>
                    </div>
                    <div class="modal-footer">
                       

                        <button type="button" class="btn btn-danger ms-2" id="limpiar" data-bs-dismiss="modal"><i
                                class="fas fa-close"></i> Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>