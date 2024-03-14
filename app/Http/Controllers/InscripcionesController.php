<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\controllers\QueryException;
use Illuminate\Http\Request;
use App\Models\Inscripcione;
use App\Models\Proyecto;

class InscripcionesController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $inscripciones = Inscripcione::all();
            $proyectos = Proyecto::pluck('nombre');
            $selectclaveproyecto = Proyecto::where('estado', true)->orderBy('clave_proyecto', 'asc')->pluck('clave_proyecto', 'id');
            // $proyecto = Proyecto::select('clave_proyecto', 'nombre')->where('id', 'clave_proyecto')->first();

            // if ($proyecto) {
            //     return response()->json([
            //         'clave_proyecto' => $proyecto->clave_proyecto,
            //         'nombre_proyecto' => $proyecto->nombre,
            //     ]);
            // } else {
            //     return response()->json(['mensaje' => 'Proyecto no encontrado'], 404);
            // }
            // return response()->json(Inscripcione::all());

            return View::make('incripciones.index', compact('inscripciones', 'proyectos', 'selectclaveproyecto')); //
        } else {
            return redirect()->to('/');
        }
    }


    public function vistaCrear()
    {
        if (Auth::check()) {
            // $medidas= Medida::where('estado', 1)->get();
            //$inscripciones = Inscripcione::all();
            $selectclaveproyecto = Proyecto::where('estado', true)->orderBy('clave_proyecto', 'asc')->pluck('clave_proyecto', 'id');
            //$selectjuzgados = Ctgjuzgado::where('estatus', true)->orderBy('juzgado', 'asc')->pluck('juzgado', 'idjuzgado');
            // $selectjuzgados = []; //devuleve un arreglo vacío

            return View::make('incripciones.create', compact('selectclaveproyecto')); //
        } else {
            return redirect()->to('/');
        }
    }
    // public function vistaEdit()
    // {
    //     if(Auth::check()){
    //         $selectclaveproyecto = Proyecto::where('estado', true)->orderBy('clave_proyecto', 'asc')->pluck('clave_proyecto', 'id');
    //         return View::make('incripciones.edit', compact('selectclaveproyecto')); //
    //     }else{
    //         return redirect()->to('/');
    //     }
    // }
    public function crearInscripcion(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                // 'nombredelcampo' => 'required | email | unique:tabla', 
                'nombre' => 'required',
                'direccion' => 'required',
                // 'descripcion_edit' => 'required',
                'claveProyecto' => 'required',
                // 'nombreProyecto' => 'required',
                // 'comite' => 'required',
                'alcaldia' => 'required',
                'telefono' => 'required | numeric',
                'concepto' => 'required',
                'importeInscripcion' => 'required | numeric',
                'noSolicitud' => 'required',
                'fechaDeposito' => 'required',
                'fotoCliente' => 'image|mimes:jpeg,png,jpg',
                'Ine' => 'image|mimes:jpeg,png,jpg',
            ], [
                'nombre.required' => 'El campo nombre completo es requerido',
                'direccion.required' => 'El campo direccion es requerido',
                'claveProyecto.required' => 'La clave del proyecto es requerida',
                'alcaldia.required' => 'El campo alcaldía es requerido',
                'telefono.required' => 'El campo teléfono es requerido',
                'concepto.required' => 'El campo comcepto es requerido',
                'importeInscripcion.required' => 'El campo Importe Inscripción es requerido',
                'noSolicitud.required' => 'El número de solicitud es requerida',
                'fechaDeposito.required' => 'La fecha del depósito es requerida',

            ]);
            try {
                DB::beginTransaction();
                // dd($request->all());
                $inscripcion = new Inscripcione();
                $inscripcion->nombre_completo = $request->input('nombre');
                $inscripcion->direccion = $request->input('direccion');
                $claveProyecto = $request->input('claveProyecto');


                $proyecto = Proyecto::where('clave_proyecto', $claveProyecto)->first();


                if (!$proyecto) {
                    return response()->json([
                        'mensaje' => 'Error al guardar: El proyecto con clave_proyecto ' . $claveProyecto . ' no existe.',
                        'idnotificacion' => 3
                    ]);
                }

                $inscripcion->clave_proyecto = $proyecto->clave_proyecto;

                // $inscripcion->nombreProyecto  = $request->input('nombreProyecto');
                $inscripcion->comite = $request->input('comite');
                $inscripcion->alcaldia = $request->input('alcaldia');
                $inscripcion->telefono = $request->input('telefono');
                $inscripcion->concepto = $request->input('concepto');
                $inscripcion->importe = $request->input('importeInscripcion');
                $inscripcion->numero_solicitud = $request->input('noSolicitud');
                $inscripcion->fecha_deposito = $request->input('fechaDeposito');
                $inscripcion->fecha_registro = \Carbon\Carbon::now();
                // Genera los nuevos nombres de archivo usando el ID de inscripción
                $nuevoNombreFotoCliente = $inscripcion->id . "foto_cliente." . pathinfo($request->file('fotoCliente')->getClientOriginalName(), PATHINFO_EXTENSION);
                $nuevoNombreIne = $inscripcion->id . "foto_ine." . pathinfo($request->file('Ine')->getClientOriginalName(), PATHINFO_EXTENSION);

                // Guarda las imágenes con los nuevos nombres
                if ($request->hasFile('fotoCliente')) {
                    $inscripcion->url_foto_cliente = $request->file('fotoCliente')->storeAs('images/photo', $nuevoNombreFotoCliente, 'public');
                }

                if ($request->hasFile('Ine')) {
                    $inscripcion->url_foto_ine = $request->file('Ine')->storeAs('images/photo', $nuevoNombreIne, 'public');
                    // dd($inscripcion);
                }
                $inscripcion->hora_registro = date("H:i:s");
                $inscripcion->estado = 1;
                $inscripcion->save();

                DB::commit();

                // Después de guardar exitosamente
                return response()->json([
                    'mensaje' => 'Inscripción realizada con éxito',
                    'idnotificacion' => 1
                ]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json([
                    'mensaje' => 'Error al guardar: ' . $e->getMessage(),
                    'idnotificacion' => 2
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    // public function nuevainscripcion(Request $request)
    // {
    //     if (Auth::check()) {
    //         $request->validate([
    //             // 'nombredelcampo' => 'required | email | unique:tabla', 
    //             'nombre' => 'required',
    //             'direccion' => 'required',
    //             // 'descripcion_edit' => 'required',
    //             'claveProyecto' => 'required',
    //             'nombreProyecto' => 'required',
    //             'comite' => 'required',
    //             'alcaldia' => 'required',
    //             'telefono' => 'required | numeric',
    //             'concepto' => 'required',
    //             'importeInscripcion' => 'required | numeric',
    //             'noSolicitud' => 'required',
    //             'fechaDeposito' => 'required',
    //             'fotoCliente' => 'image|mimes:jpeg,png,jpg',
    //             'Ine' => 'image|mimes:jpeg,png,jpg',
    //         ]);
    //         try {
    //             DB::beginTransaction();
    //             // dd($request);
    //             $inscripcion = new Inscripcione();
    //             $inscripcion->nombre_completo = $request->input('nombre');
    //             $inscripcion->direccion = $request->input('direccion');
    //             $inscripcion->clave_proyecto = $request->input('claveProyecto');
    //             $inscripcion->nombreProyecto  = $request->input('nombreProyecto');
    //             $inscripcion->comite = $request->input('comite');
    //             $inscripcion->alcaldia = $request->input('alcaldia');
    //             $inscripcion->telefono = $request->input('telefono');
    //             $inscripcion->concepto = $request->input('concepto');
    //             $inscripcion->importe = $request->input('importeInscripcion');
    //             $inscripcion->numero_solicitud = $request->input('noSolicitud');
    //             $inscripcion->fecha_deposito = $request->input('fechaDeposito');
    //             $inscripcion->fecha_registro = \Carbon\Carbon::now();
    //             // Genera los nuevos nombres de archivo usando el ID de inscripción
    //             $nuevoNombreFotoCliente = $inscripcion->id . "_cliente." . pathinfo($request->file('fotoCliente')->getClientOriginalName(), PATHINFO_EXTENSION);
    //             $nuevoNombreIne = $inscripcion->id . "_ine." . pathinfo($request->file('Ine')->getClientOriginalName(), PATHINFO_EXTENSION);

    //             // Guarda las imágenes con los nuevos nombres
    //             if ($request->hasFile('fotoCliente')) {
    //                 $inscripcion->url_foto_cliente = $request->file('fotoCliente')->storeAs('images/photo/', $nuevoNombreFotoCliente, 'public');
    //             }

    //             if ($request->hasFile('Ine')) {
    //                 $inscripcion->url_foto_ine = $request->file('Ine')->storeAs('images/photo/', $nuevoNombreIne, 'public');
    //             }
    //             $inscripcion->hora_registro = date("H:i:s");
    //             $inscripcion->estado = 1;
    //             $inscripcion->save();

    //             DB::commit();

    //             // Después de guardar exitosamente
    //             return response()->json([
    //                 'mensaje' => 'Inscripción realizada con éxito',
    //                 'idnotificacion' => 1
    //             ]);

    //         } catch (\Exception $e) {

    //             DB::rollback();
    //             return response()->json([
    //                 'mensaje' => 'Error al guardar: ' . $e->getMessage(),
    //                 'idnotificacion' => 2
    //             ]);
    //         } 
    //     } else {
    //         return redirect()->to('/');
    //     }
    // }

    public function getClavePoryectoRelaciones($id = 0)
    {
        if ($id == 0) {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        } else {
            $proyecto = Proyecto::select('clave_proyecto', 'nombre')->where('id', $id)->first();

            if ($proyecto) {
                return response()->json([
                    'clave_proyecto' => $proyecto->clave_proyecto,
                    'nombre_proyecto' => $proyecto->nombre,
                ]);
            } else {
                return response()->json(['mensaje' => 'Proyecto no encontrado'], 404);
            }
        }
    }

    
    public function editInscripcion($id)
    {
        if (Auth::check()) {
            try {

                if (Auth::check()) {
                    $proyecto = Proyecto::select('clave_proyecto', 'nombre')->where('id', $id)->first();
                    $selectclaveproyecto = Proyecto::where('estado', true)->orderBy('clave_proyecto', 'asc')->pluck('clave_proyecto', 'id');
                    $inscripcion = Inscripcione::find($id);
                    return view('incripciones.edit', compact('proyecto', 'inscripcion', 'selectclaveproyecto'));
                } else {
                    return redirect()->to('/');
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            return redirect()->to('/');
        }
    }
    // public function editInscripcion($id)
    // {
    //     $inscripcion = Inscripcione::find($id);

    //     if ($inscripcion) {
    //         return response()->json($inscripcion);
    //     } else {
    //         return response()->json(['error' => 'Proyecto no encontrada'], 404);
    //     }
    // }

    public function actualizarInscripcion($id, Request $request)
    {


        if (Auth::check()) {
            // dd($request->all());
            $request->validate([
                // 'nombredelcampo' => 'required | email | unique:tabla', 
                'nombre_edit' => 'required',
                'direccion_edit' => 'required',
                // 'descripcion_edit' => 'required',
                'claveProyecto_edit' => 'required',
                // 'nombreProyecto' => 'required',
                // 'comite' => 'required',
                'alcaldia_edit' => 'required',
                'telefono_edit' => 'required',
                'concepto_edit' => 'required',
                'importeInscripcion_edit' => 'required | numeric',
                'noSolicitud_edit' => 'required',
                'fechaDeposito_edit' => 'required',
                'fotoCliente_edit' => 'image|mimes:jpeg,png,jpg',
                'Ine_edit' => 'image|mimes:jpeg,png,jpg',
            ], [
                'nombre_edit.required' => 'El campo nombre completo es requerido',
                'direccion_edit.required' => 'El campo direccion es requerido',
                'claveProyecto_edit.required' => 'La clave del proyecto es requerida',
                'alcaldia_edit.required' => 'El campo alcaldía es requerido',
                'telefono_edit.required' => 'El campo teléfono es requerido',
                'concepto_edit.required' => 'El campo comcepto es requerido',
                'importeInscripcion_edit.required' => 'El campo Importe Inscripción es requerido',
                'noSolicitud_edit.required' => 'El número de solicitud es requerida',
                'fechaDeposito_edit.required' => 'La fecha del depósito es requerida',

            ]);
            

            DB::beginTransaction();
            try {
                $inscripcion =  Inscripcione::find($id);
                $inscripcion->nombre_completo = $request->input('nombre_edit');
                $inscripcion->direccion = $request->input('direccion_edit');
                $claveProyecto = $request->input('claveProyecto_edit');


                $proyecto = Proyecto::where('clave_proyecto', $claveProyecto)->first();


                if (!$proyecto) {
                    return response()->json([
                        'mensaje' => 'Error al guardar: El proyecto con clave_proyecto ' . $claveProyecto . ' no existe.',
                        'idnotificacion' => 3
                    ]);
                }

                $inscripcion->clave_proyecto = $proyecto->clave_proyecto;

                // $inscripcion->nombreProyecto  = $request->input('nombreProyecto');
                $inscripcion->comite = $request->input('comite_edit');
                $inscripcion->alcaldia = $request->input('alcaldia_edit');
                $inscripcion->telefono = $request->input('telefono_edit');
                $inscripcion->concepto = $request->input('concepto_edit');
                $inscripcion->importe = $request->input('importeInscripcion_edit');
                $inscripcion->numero_solicitud = $request->input('noSolicitud_edit');
                $inscripcion->fecha_deposito = $request->input('fechaDeposito_edit');
                // $inscripcion->fecha_registro = \Carbon\Carbon::now();
                // Genera los nuevos nombres de archivo usando el ID de inscripción
                $nuevoNombreFotoCliente = $inscripcion->id . "foto_cliente." . pathinfo($request->file('fotoCliente')->getClientOriginalName(), PATHINFO_EXTENSION);
                $nuevoNombreIne = $inscripcion->id . "foto_ine." . pathinfo($request->file('Ine')->getClientOriginalName(), PATHINFO_EXTENSION);

                // Guarda las imágenes con los nuevos nombres
                if ($request->hasFile('fotoCliente_edit')) {
                    $inscripcion->url_foto_cliente = $request->file('fotoCliente')->storeAs('images/photo', $nuevoNombreFotoCliente, 'public');
                }

                if ($request->hasFile('Ine_edit')) {
                    $inscripcion->url_foto_ine = $request->file('Ine')->storeAs('images/photo', $nuevoNombreIne, 'public');
                    // dd($inscripcion);
                }
                // if($request->imagen){
                //     $imagen = $request->imagen('fotoCliente_edit');
                //     $nombreImagen = Str::uui() . "." . $imagen->extension();
                //     $rutaGuardado = $request->file('Ine')->storeAs('images/photo', $nombreImagen, 'public');
                // }
                // $inscripcion->hora_registro = date("H:i:s");
                $inscripcion->estado = 1;
                $inscripcion->save();

                DB::commit();

                return response()->json([
                    'mensaje' => 'Inscripción actualizada con éxito',
                    'idnotificacion' => 1
                ]);
                // return response()->json([
                //     'mensaje' => 'La clave del proyecto ya existe.',
                //     'idnotificacion' => 3 // Esto indica que es un error de validación
                // ], 422); // Devuelve el código de estado HTTP 422 para indicar una validación fallida
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'mensaje' => 'Error al actualizar: ' . $e->getMessage(),
                    'idnotificacion' => 2
                ]);
                
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function eliminarInscripcion($id)
    {
        if (Auth::check()) {
            $inscripcion = Inscripcione::find($id);

            $inscripcion->delete();
        } else {
            return redirect()->to('/');
        }
    }
}
