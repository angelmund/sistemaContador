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


class ProyectosController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $proyectos = Proyecto::all();
            // $proyectos = Proyecto::pluck('nombre');
            // return response()->json(Inscripcione::all());

            return View::make('proyectos.index', compact('proyectos')); //
        } else {
            return redirect()->to('/');
        }
    }

    public function proyecto()
    {

        if (Auth::check()) {
            return view::make('proyectos.create');
        } else {
            return redirect()->to('/');
        }
    }
    public function tableProyectos($id){
        if (Auth::check()) {
            $proyecto = Proyecto::with('inscripciones')->find($id);
            return View::make('proyectos.proyectosTable', compact('proyecto'));
        } else {
            return redirect()->to('/');
        }
    }
    public function createProyecto(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                // 'nombredelcampo' => 'required | email | unique:tabla', 
                'claveProyecto_new' => 'required','unique:proyectos,clave_proyecto,except,id',
                'nombre_new' => 'required',
                // 'descripcion_edit' => 'required',
                'nombreEncargado_new' => 'required',
                'ubicacion_new' => 'required',
                'cantParticipantes_new' => 'required | numeric',
                'presupuestoN' => 'required | numeric',

            ], [
                'nombre_new.unique' => 'La clave del proyecto ya existe.'
            ]);
            return response()->json([
                'mensaje' => 'La clave del proyecto ya existe.',
                'idnotificacion' => 3 // Esto indica que es un error de validación
            ], 422); // Devuelve el código de estado HTTP 422 para indicar una validación fallida

            DB::beginTransaction();
            try {
               
                $proyecto = new Proyecto();
                $proyecto->clave_proyecto = $request->input('claveProyecto_new');
                $proyecto->nombre = $request->input('nombre_new');
                $proyecto->descripcion = $request->input('descripcion_new');
                $proyecto->encargado = $request->input('nombreEncargado_new');
                $proyecto->ubicacion = $request->input('ubicacion_new');
                $proyecto->cantMaxParticipantes = $request->input('cantParticipantes_new');
                $proyecto->presupuesto = $request->input('presupuestoN');
                $proyecto->fecha_registro = now(); // Establecer la fecha actual
                $proyecto->estado = 1;
                $proyecto->save();

                DB::commit();

                return response()->json([
                    'mensaje' => 'Proyecto guardado con éxito',
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

    public function editProyecto($id)
    {
        // if (Auth::check() && Auth::user()->tipoUsuario == "ADMINISTRADOR") {
        //     $datos['usuario']=User::where("correo",Auth::user()->correo)->first();
        // }

        if (Auth::check()) {
            try {

                $proyectos = Proyecto::find($id);

                if ($proyectos) {
                    return response()->json($proyectos);
                } else {
                    return response()->json(['error' => 'Proyecto no encontrada'], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function updateProyecto(Request $request, $id)
    {
        // if (Auth::check() && Auth::user()->tipoUsuario == "ADMINISTRADOR") {
        //     $datos['usuario']=User::where("correo",Auth::user()->correo)->first();
        // }
        if (Auth::check()) {
            $request->validate([
                // 'nombredelcampo' => 'required | email | unique:tabla', 
                'claveProyecto_edit' => 'required',
                'nombreProyecto_edit' => 'required',
                // 'descripcion_edit' => 'required',
                'ubicacion_edit' => 'required',
                'encargado_edit' => 'required',
                'presupuesto_edit' => 'required | numeric',
                'cantMaxParticipantes_edit' => 'required | numeric',

            ]);
            DB::beginTransaction();
            try {
                $proyectos =  proyecto::find($id);
                $proyectos->clave_proyecto = $request->input('claveProyecto_edit');
                $proyectos->nombre = $request->input('nombreProyecto_edit');
                $proyectos->descripcion = $request->input('descripcion_edit');
                $proyectos->encargado = $request->input('encargado_edit');
                $proyectos->presupuesto  = $request->input('presupuesto_edit');
                $proyectos->cantMaxParticipantes = $request->input('cantMaxParticipantes_edit');
                $proyectos->estado = 1;
                $proyectos->save();

                DB::commit();

                return response()->json([
                    'mensaje' => 'Proyecto Editado con éxito',
                    'idnotificacion' => 1
                ]);
            } catch (QueryException $e) {

                DB::rollback();
                return response()->json([
                    'mensaje' => 'Error al actualizar: ' . $e->getMessage(),
                    'idnotificacion' => 2
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'mensaje' => 'Error al guardar: ' . $e->getMessage(),
                    'idnotificacion' => 3
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    // public function mostrarPorId($id, $tabla)
    // {
    //     $inscripcion = Inscripcione::select('inscripciones.*', 'proyectos.nombre AS nombre_proyecto')
    //         ->join('proyectos', 'inscripciones.clave_proyecto', '=', 'proyectos.clave_proyecto')
    //         ->where('inscripciones.id', $id)
    //         ->first();

    //     return view::make('proyectos.edit', compact('inscripcion'));
    // }

    public function eliminarproyecto($id)
    {
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                $proyecto = Proyecto::find($id);
                // $proyecto->estado = 0;
                $proyecto->delete();
                // $proyecto->save();

                DB::commit();

                return response()->json([
                    'mensaje' => 'Eliminado con éxito',
                    'idnotificacion' => 1
                ]);
            } catch (QueryException $e) {

                DB::rollback();
                return response()->json([
                    'mensaje' => 'Error al eliminar: ' . $e->getMessage(),
                    'idnotificacion' => 2
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'mensaje' => 'Error al eliminar: ' . $e->getMessage(),
                    'idnotificacion' => 2
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }
}
