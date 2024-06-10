<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
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
                        <input type="text" id="id_proyecto" value="">
                        <div class="row mb-3">

                            <div class="col">
                                <label for="id_cliente">Folio Cliente:</label>
                                <select id="id_cliente" class="form-control select-beast" name="id_cliente" required>
                                    <option value="" disabled selected>-- Selecciona un folio --</option>

                                    @foreach ($inscripciones as $inscripcion)
                                    <option value="{{ $inscripcion->id }}">{{ $inscripcion->id }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecciona un folio.
                                </div>
                            </div>

                            <div class="col-auto">
                                <button type="button" class="btn btn-primary abrir-id" id="id_user"
                                    value="">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Cliente:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" readonly>
                        </div>
                        {{-- <div class="mb-3">
                            <legend class="title text-center">Proyecto asigando</legend>
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label for="id_proyecto" class="form-label">Clave Proyecto:</label>
                            <select name="id_proyecto" id="id_proyecto" class="form-select select2" required>
                                <option value="" disabled selected>-- Selecciona un proyecto --</option>
                                @foreach ($selectclaveproyecto as $id => $clave_proyecto)
                                <option value="{{ $id }}">{{ $clave_proyecto }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Por favor selecciona un proyecto.
                            </div>
                        </div> --}}


                        {{-- <div class="mb-3">
                            <label for="nombreProyecto_n" class="form-label">Nombre Proyecto:</label>
                            <input type="text" class="form-control" id="nombreProyecto_n" name="nombreProyecto_n"
                                readonly>
                        </div> --}}
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
                            <textarea type="text" class="form-control" id="observaciones" name="observaciones"
                                required></textarea>
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
    @include('pagos.inscripcionId')

    <script>
        $(document).ready(function() {
            
            new TomSelect(".select-beast",{
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    </script>
</x-app-layout>