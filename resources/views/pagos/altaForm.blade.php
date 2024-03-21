<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
<x-app-layout>

    <div class="container">
        <div class="row mt-6">
            <div class="card mt-5 ">
                <div class="card-body ">
                    <h1 class="text-center">Formulario de Pagos</h1>
                    <input type="hidden" value="{{ url('/') }}" id="url">
                    <form class="needs-validation" id="formAlta-pagos" action="#" method="POST"
                        enctype="multipart/form-data" class="bg-Light p-4 rounded needs-validation" novalidate>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row mb-3">
                            <label for="folio" class="form-label">Folio Cliente:</label>

                            <div class="col">
                                <select name="claveProyecto" id="claveProyecto" class="form-select select2">
                                    <option selected disabled>Seleccione una opción</option>
                                    @foreach ($inscripciones as $inscripcion)
                                        <option value="{{ $inscripcion->id }}">{{ $inscripcion->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-auto">
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Cliente:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="mb-3">
                            <legend class="title text-center">Información Pago</legend>
                        </div>

                        <div class="mb-3">
                            <label for="concepto_pago">Concepto:</label>
                            <select id="concepto_pago" class="form-control select2" name="conceptoPago" required>
                                <option value="" disabled selected>-- Selecciona un Concepto --</option>
                                <option value="pago">Pago o Ahorro</option>
                                <option value="cheque">Cheque</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor selecciona un concepto.
                            </div>
                        </div>
                        
                        <div class="mb-3 cheque d-none">
                            <label for="numeroChequePago">Numero Cheque:</label>
                            <input class="form-control" type="text" name="numeroChequePago" id="numeroChequePago"
                                required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">
                                Por favor agregue un número de cheque.
                            </div>

                        </div>
                        <div class="mb-3 cheque d-none">
                            <label for="NumeroCuentaBancaria" class="form-label">Numero Cuenta Bancaria:</label>
                            <input type="text" class="form-control" id="NumeroCuentaBancaria"
                                name="NumeroCuentaBancaria" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">
                                Por favor agregue un número de cuenta.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="referencia" class="form-label">Referencia Pago:</label>
                            <input type="text" class="form-control" id="referencia" name="referencia" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">
                                Por favor ingrese una referencia de pago.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="monto" class="form-label">Monto:</label>
                            <input type="text" class="form-control" id="monto" name="monto" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">
                                Por favor ingrese el monto.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="montLetra" class="form-label">Monto en letra:</label>
                            <input type="text" class="form-control" id="montLetra" name="montLetra" readonly required>
                        </div>

                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones:</label>
                            <textarea type="text" class="form-control" id="observaciones" name="observaciones" required></textarea>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">
                                Por favor ingrese la observación.
                            </div>
                        </div>
                        

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btn_save"><i class="fas fa-save"></i>
                                Guardar</button>
                            <button type="button" class="btn btn-danger ms-2" id="limpiar" data-bs-dismiss="modal"><i
                                    class="fas fa-trash"></i> Limpiar formulario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>