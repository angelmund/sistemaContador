<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Ruta inscripciones
Route::group(['middleware' => ['auth']], function () {
    Route::get('/inscripciones', [App\Http\Controllers\InscripcionesController::class, 'index'])->name('inscripciones.index');
    Route::get('/inscripciones/form', [App\Http\Controllers\InscripcionesController::class, 'vistaCrear'])->name('inscripciones.form');
    Route::post('/inscripciones/nuevo', [App\Http\Controllers\InscripcionesController::class, 'crearInscripcion'])->name('inscripciones.nuevo');
    Route::get('/inscripciones/relacion/{id}', [App\Http\Controllers\InscripcionesController::class, 'getClavePoryectoRelaciones'])->name('inscripciones.relacionClave');
    // Route::get('/inscripciones/formato/{id}', [App\Http\Controllers\InscripcionesController::class, 'crearInscripcion'])->name('inscripciones.formato');
    Route::get('/inscripciones/formato/{id}', [App\Http\Controllers\InscripcionesController::class, 'mostrarFormato'])->name('inscripciones.formato');
    Route::get('/inscripciones/edit/{id}', [App\Http\Controllers\InscripcionesController::class, 'editInscripcion'])->name('inscripciones.edit');
    Route::post('/inscripciones/delete/{id}', [App\Http\Controllers\InscripcionesController::class, 'eliminarInscripcion'])->name('inscripciones.delete');
    Route::post('/inscripciones/update/{id}', [App\Http\Controllers\InscripcionesController::class, 'actualizarInscripcion'])->name('inscripciones.actualizar');
    // Route::get('/inscripciones/edit/{id}', [App\Http\Controllers\InscripcionesController::class, 'editInscripcion'])->name('inscripciones.edit');

})->middleware(['auth', 'verified'])->name('inscripciones');


//Ruta proyectos
Route::group(['middleware' => ['auth']], function () {
    Route::get('/proyectos', [App\Http\Controllers\ProyectosController::class, 'index'])->name('proyectos.index');
    Route::get('/proyectos/create', [App\Http\Controllers\ProyectosController::class, 'proyecto'])->name('proyectos.create');
    Route::get('/proyectos/proyectosTable/{id}', [App\Http\Controllers\ProyectosController::class, 'tableProyectos'])->name('proyectos.tableProyectos');

    Route::post('/proyectos/save', [App\Http\Controllers\ProyectosController::class, 'createProyecto'])->name('proyectos.save');
    Route::get('/proyectos/edit/{id}', [App\Http\Controllers\ProyectosController::class, 'editProyecto'])->name('proyectos.edit');
    Route::post('/proyectos/update/{id}', [App\Http\Controllers\ProyectosController::class, 'updateProyecto'])->name('proyectos.update');
    // Route::get('/inscripciones/datos', [App\Http\Controllers\InscripcionesController::class, 'datos'])->name('inscripciones.datos');
    // Route::post('/categorias/createcategoria', [App\Http\Controllers\CategoriaController::class, 'store'])->name('categorias.create');
    // Route::get('/categorias/editcategoria/{idcategoria}', [App\Http\Controllers\CategoriaController::class, 'show'])->name('categorias.edit');
    // Route::post('/categorias/updatecategoria/{idcategoria}', [App\Http\Controllers\CategoriaController::class, 'update'])->name('categorias.update');
    // Route::delete('/categorias/eliminarcategoria/{idcategoria}', [App\Http\Controllers\CategoriaController::class, 'eliminarcategoria'])->name('categorias.eliminar');
})->middleware(['auth', 'verified'])->name('proyectos');

//Ruta pagos
Route::group(['middleware' => ['auth']], function () {
    Route::get('/altaPagos/{id}', [App\Http\Controllers\PagosController::class, 'formulario'])->name('pagos.alta');
    Route::get('/listaPagos', [App\Http\Controllers\PagosController::class, 'index'])->name('pagos.lista');
    Route::post('/listaPagos/ingreso', [App\Http\Controllers\PagosController::class, 'nuevoIngreso'])->name('pagos.ingreso');
    Route::get('/pago/alta', [App\Http\Controllers\PagosController::class, 'formIngreso'])->name('pagos.nuevo');
})->middleware(['auth', 'verified'])->name('pagos');

//Ruta cheques 
Route::group(['middleware' => ['auth']], function () {
    Route::get('/listaCheques', [App\Http\Controllers\PagosController::class, 'Cheques'])->name('cheques.lista');
    Route::get('/pagosPersona/{tipo}/{id}', [App\Http\Controllers\PagosController::class, 'mostrarPagoPersona'])->name('cheques.persona');
    Route::post('/cancelar/pago/{id}', [App\Http\Controllers\PagosController::class, 'cancelarPago'])->name('pagos.cancelar');
    Route::post('/cancelar/cheque/{id}', [App\Http\Controllers\PagosController::class, 'cancelarCheque'])->name('cheques.cancelar');
    Route::get('/cheques/inscripcion/{id}', [App\Http\Controllers\PagosController::class, 'Pagos'])->name('personaPagos.inscripcion');
    // Route::get('/pagos/inscripcion/{id}', [App\Http\Controllers\PagosController::class, 'Pagos'])->name('pagos.pagos');
})->middleware(['auth', 'verified'])->name('pagos');



//Ruta admin
Route::group(['middleware' => ['auth']], function () {
    Route::get('/usuarios', [App\Http\Controllers\AdminController::class, 'usuarios'])->name('usuarios.index');
    Route::get('/usuarios/create', [App\Http\Controllers\AdminController::class, 'create'])->name('usuarios.create');
    Route::delete('/usuarios/delete/{id}', [App\Http\Controllers\AdminController::class, 'eliminarUsuario'])->name('usuarios.delete');
    Route::resource('/usuario/roles', App\Http\Controllers\RolesController::class)->names('usuarios.roles');
    Route::resource('/usuario/permisos', App\Http\Controllers\PermisosController::class)->names('usuarios.permisos');
    // Route::get('/usuario/asignarRol/{id}', [App\Http\Controllers\AdminController::class, 'asignarRolEdit'])->name('usuario.rol');
    Route::resource('/usuario/asignarRol', App\Http\Controllers\AsignarController::class)->names('usuario.RolAsignado');
    Route::delete('/usuario/asignarRol/{id}', [App\Http\Controllers\AsignarController::class, 'destroy'])->name('usuario.Roldelete');
})->middleware(['auth', 'verified'])->name('admin');



require __DIR__ . '/auth.php';
