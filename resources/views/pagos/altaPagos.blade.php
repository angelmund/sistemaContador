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
                    <form id="formAlta-pagos" action="#" method="POST" enctype="multipart/form-data"
                        class="bg-Light p-4 rounded">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="folio" class="form-label">Folio Cliente:</label>

                            <div class="col">
                                <input type="text" class="form-control" id="id" name="id" value="{{$inscripcion->id}}"
                                    readonly>
                                @error('id')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Cliente:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="{{$inscripcion->proyecto->encargado}}" readonly>
                            @error('nombre')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <legend class="title text-center">Información Pago</legend>
                        </div>

                        <div class="mb-3">
                            <label for="conceptoPago">Concepto: </label>
                            <select id="concepto_pago" class="form-control" name="conceptoPago" required>
                                <option value="ninguno">-- Selecciona un Concepto --</option>
                                <option value="pago">Pago o Ahorro</option>
                                <option value="cheque">Cheque</option>
                            </select>
                            @error('concepto_pago')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-3 cheque" style="display: none;">
                            <label for="numeroChequePago">Numero Cheque:</label>
                            <input class="form-control" type="text" name="numeroChequePago" required>
                            @error('numeroChequePago')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-3 cheque" style="display: none;">
                            <label for="NumeroCuentaBancaria" class="form-label">Numero Cuenta Bancaria:</label>
                            <input type="text" class="form-control" id="NumeroCuentaBancaria"
                                name="NumeroCuentaBancaria">
                            @error('NumeroCuentaBancaria')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="referencia" class="form-label">Referencia Pago:</label>
                            <input type="text" class="form-control" id="referencia" name="referencia">
                            @error('referencia')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="monto" class="form-label">Monto:</label>
                            <input type="text" class="form-control" id="monto" name="monto">
                            @error('monto')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="montLetra" class="form-label">Monto en letra:</label>
                            <input type="text" class="form-control" id="montLetra" name="montLetra">
                        </div>

                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones:</label>
                            <textarea type="text" class="form-control" id="observaciones"
                                name="observaciones"> </textarea>
                            
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btn_save"><i class="fas fa-save"></i>
                                Guardar inscripción</button>
                            <button type="button" class="btn btn-danger ms-2" id="limpiar" data-bs-dismiss="modal"><i
                                    class="fas fa-trash"></i> Limpiar formulario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>