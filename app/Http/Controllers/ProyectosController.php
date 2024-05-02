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
use App\Models\Cheque;
use App\Models\Pago;

class ProyectosController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $proyectos = Proyecto::with('inscripciones')->get();
            $totalPresupuesto = $proyectos->sum('presupuesto');
            // Obtener todos los cheques, activos e inactivos
            $cheques = Cheque::all();

            // Obtener todos los pagos, activos e inactivos
            $pagos = Pago::all();

            // Calcular la suma de los montos de los cheques activos
            $totalMontoCheques = $cheques->where('estado', 1)->sum('monto');

            // Calcular la suma de los montos de los pagos activos
            $totalMontoPagos = $pagos->where('estado', 1)->sum('monto');

            // Calcular el total mostrando la diferencia entre los montos de pagos y cheques
            $mostrarTotal = $totalMontoPagos - $totalMontoCheques;

            //Cantidad de inscritos a un proyecto 
            $sumaCheques = $proyectos->count();

            return view('proyectos.index', compact('proyectos', 'totalPresupuesto', 'mostrarTotal'));
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
    public function getTotalPagosUsuario($idUsuario)
    {
        $totalPagos = Pago::where('id_cliente', $idUsuario)->sum('monto');
        return $totalPagos;
    }
    public function tableProyectos($id)
    {
        if (Auth::check()) {
            $proyecto = Proyecto::with('inscripciones')->find($id);

            //recorre cada uno de los pagos 
            foreach ($proyecto->inscripciones as $inscripcion) {
                $totalPagos = Pago::where('id_cliente', $inscripcion->id)
                    ->where('estado', 1) //devulve solo los que tengan un estado =1
                    ->sum('monto'); //hace la suma de los montos de los pagos 
                $inscripcion->totalPagos = $totalPagos;
            }

            return view('proyectos.proyectosTable', compact('proyecto'));
        } else {
            return redirect()->to('/');
        }
    }
    public function createProyecto(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                // 'nombredelcampo' => 'required | email | unique:tabla', 
                'claveProyecto_new' => 'required', 'unique:proyectos,clave_proyecto,except,id',
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
