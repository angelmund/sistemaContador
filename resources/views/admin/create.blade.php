<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
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
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" >
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Correo:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" >
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Rol:</label>
                            <select id="concepto_pago" class="form-control" name="conceptoPago" required>
                                <option value="Admin">Administrador</option>
                                <option value="Usuario">Usuario</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btn_save"><i
                                    class="fas fa-save"></i> Guardar Usuario</button>
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