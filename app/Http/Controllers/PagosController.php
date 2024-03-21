<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\controllers\QueryException;
use App\Models\Cheque;
use Illuminate\Http\Request;
use App\Models\Inscripcione;
use App\Models\Pago;
use App\Models\Proyecto;
use App\Models\User;
use Exception;

class PagosController extends Controller
{
    //muestra la lista de pagos
    public function index()
    {
        if (Auth::check()) {
            $pagos = Pago::all();
            return view::make('pagos.listaPagos', compact('pagos'));
        } else {
            return redirect()->to('/');
        }
    }

    public function formulario($id)
    {
        if (Auth::check()) {
            $inscripcion = Inscripcione::find($id);
            return view::make('pagos.altaPagos', compact('inscripcion'));
        } else {
            return redirect()->to('/');
        }
    }
    //muestra la lista de cheques
    public function Cheques()
    {
        if (Auth::check()) {
            $cheques = Cheque::all();
            $pagos =  Pago::all();
            $proyectos = Proyecto::pluck('nombre');
            $inscripciones = Inscripcione::pluck('nombre_completo', 'id');
            $usuario = User::pluck('name');
            return view::make('cheques.listaCheques', compact('cheques', 'proyectos', 'inscripciones', 'usuario', 'pagos'));
        } else {
            return redirect()->to('/');
        }
    }
    public function nuevoIngreso(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'numeroChequePago' => 'required_if:conceptoPago,cheque',
                'NumeroCuentaBancaria' => 'required_if:conceptoPago,cheque',
                'referencia' => 'required',
                'monto' => 'required|numeric',
            ], [
                'numeroChequePago.required_if' => 'El campo es requerido',
                'NumeroCuentaBancaria.required_if' => 'El campo es requerido',
                'referencia.required' => 'El campo es requerido',
                'monto.required' => 'El campo es requerido',
                'monto.numeric' => 'El campo debe ser numérico',
            ]);

            try {
                DB::beginTransaction();

                $conceptoPago = $request->input('conceptoPago');

                if ($conceptoPago === 'pago') {
                    // Guardar en la tabla de pagos 
                    $pago = new Pago();
                    $pago->fecha = \Carbon\Carbon::now();
                    $pago->hora = Carbon::now()->toTimeString();
                    $pago->monto = $request->input('monto');
                    $pago->referencia_pago  = $request->input('referencia');
                    $pago->descripcion = $request->input('observaciones');
                    $pago->id_cliente = $request->input('id_cliente');
                    $pago->id_proyecto = $request->input('id_proyecto');
                    $pago->id_usuario = Auth::id();
                    $pago->estado = 1;
                    $pago->save();

                    DB::commit();

                    return response()->json([
                        'mensaje' => 'Pago agregado con éxito',
                        'idnotificacion' => 1
                    ]);
                } elseif ($conceptoPago === 'cheque') {
                    // Guardar el cheque
                    $cheque = new Cheque();
                    $cheque->fecha = \Carbon\Carbon::today();
                    $cheque->hora = \Carbon\Carbon::now()->format('H:i:s');
                    $cheque->numero_cheque = $request->input('numeroChequePago');
                    $cheque->monto = $request->input('monto');
                    $cheque->numero_cuentabancaria = $request->input('NumeroCuentaBancaria');
                    $cheque->id_cliente = $request->input('id_cliente');
                    $cheque->id_proyecto = $request->input('id_proyecto');
                    $cheque->id_usuario = Auth::id();
                    $cheque->save();
                    DB::commit();

                    return response()->json([
                        'mensaje' => 'Cheque agregado con éxito',
                        'idnotificacion' => 1
                    ]);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'mensaje' => 'Error al guardar el pago: ' . $e->getMessage(),
                    'idnotificacion' => 3
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function formIngreso(){
        if (Auth::check()) {
            // $cheques = Cheque::all();
            // $pagos =  Pago::all();
            // $proyectos = Proyecto::pluck('nombre');
            $inscripciones = Inscripcione::all();
            // $usuario = User::all();
            return view::make('pagos.altaForm', compact('inscripciones'));
        } else {
            return redirect()->to('/');
        }
    }

    public function ingressoForm(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'numeroChequePago' => 'required_if:conceptoPago,cheque',
                'NumeroCuentaBancaria' => 'required_if:conceptoPago,cheque',
                'referencia' => 'required',
                'monto' => 'required|numeric',
            ], [
                'numeroChequePago.required_if' => 'El campo es requerido',
                'NumeroCuentaBancaria.required_if' => 'El campo es requerido',
                'referencia.required' => 'El campo es requerido',
                'monto.required' => 'El campo es requerido',
                'monto.numeric' => 'El campo debe ser numérico',
            ]);

            try {
                DB::beginTransaction();

                $conceptoPago = $request->input('conceptoPago');

                if ($conceptoPago === 'pago') {
                    // Guardar en la tabla de pagos 
                    $pago = new Pago();
                    $pago->fecha = \Carbon\Carbon::now();
                    $pago->hora = Carbon::now()->toTimeString();
                    $pago->monto = $request->input('monto');
                    $pago->referencia_pago  = $request->input('referencia');
                    $pago->descripcion = $request->input('observaciones');
                    $pago->id_cliente = $request->input('id_cliente');
                    $pago->id_proyecto = $request->input('id_proyecto');
                    $pago->id_usuario = Auth::id();
                    $pago->estado = 1;
                    $pago->save();

                    DB::commit();

                    return response()->json([
                        'mensaje' => 'Pago agregado con éxito',
                        'idnotificacion' => 1
                    ]);
                } elseif ($conceptoPago === 'cheque') {
                    // Guardar el cheque
                    $cheque = new Cheque();
                    $cheque->fecha = \Carbon\Carbon::today();
                    $cheque->hora = \Carbon\Carbon::now()->format('H:i:s');
                    $cheque->numero_cheque = $request->input('numeroChequePago');
                    $cheque->monto = $request->input('monto');
                    $cheque->numero_cuentabancaria = $request->input('NumeroCuentaBancaria');
                    $cheque->id_cliente = $request->input('id_cliente');
                    $cheque->id_proyecto = $request->input('id_proyecto');
                    $cheque->id_usuario = Auth::id();
                    $cheque->save();
                    DB::commit();

                    return response()->json([
                        'mensaje' => 'Cheque agregado con éxito',
                        'idnotificacion' => 1
                    ]);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'mensaje' => 'Error al guardar el pago: ' . $e->getMessage(),
                    'idnotificacion' => 3
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }
    //cancelar cheque
    public function cancelarCheque($id)
    {
        if (Auth::check()) {

            if (Auth::check()) {
                DB::beginTransaction();
                try {
                    $cheque = Cheque::FindOrFail($id);
                    $cheque->estado = 0;
                    $cheque->save();
                    DB::commit();
                    return response()->json([
                        'mensaje' => 'Pago cancelado con éxito',
                        'idnotificacion' => 5
                    ]);
                } catch (Exception $e) {
                    DB::rollBack();
                    return response()->json([
                        'mensaje' => 'Error al cancelar',
                        'idnotificacion' => 8
                    ]);
                }
            }
        } else {
            return redirect()->to('/');
        }
    }

    //cancelar Pago
    public function cancelarPago($id)
    {
        if (Auth::check()) {

            if (Auth::check()) {
                DB::beginTransaction();
                try {
                    $pago = Pago::FindOrFail($id);
                    $pago->estado = 0;
                    $pago->save();
                    DB::commit();
                    return response()->json([
                        'mensaje' => 'Pago cancelado con éxito',
                        'idnotificacion' => 5
                    ]);
                } catch (Exception $e) {
                    DB::rollBack();
                    return response()->json([
                        'mensaje' => 'Error al cancelar',
                        'idnotificacion' => 8
                    ]);
                }
            }
        } else {
            return redirect()->to('/');
        }
    }

    //Mostrar pagos por Folio de persona 
    public function mostrarPagoPersona($tipo, $id)
    {
        if (Auth::check()) {
            if ($tipo === 'cheque') {
                $cheques = Cheque::where('id_cliente', $id)->get();
                return view('cheques.pagosPersonas', compact('cheques'));
            } elseif ($tipo === 'pago') {
                $pagos = Pago::where('id_cliente', $id)->get();
                return view('cheques.pagosPersonas', compact('pagos'));
            } else {
                // Manejar caso de tipo de pago no válido, por ejemplo, redireccionar a una página de error
                return response()->json([
                    'mensaje' => 'Pago inexistente',
                    'idnotificacion' => 1
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function Pagos($id)
    {
        if (Auth::check()) {
            $inscripcion = Inscripcione::findOrFail($id);
            $cheques = $inscripcion->cheques;
            $numCheques = $cheques->count(); // Contar la cantidad de cheques
    
            $pagos = $inscripcion->pagos;
            $numPagos = $pagos->count(); // Contar la cantidad de pagos
    
            // Sumar la cantidad de cheques y pagos
            $total = $numCheques + $numPagos;
    
            return view('cheques.pagosPersonas', compact('cheques', 'numCheques', 'pagos', 'numPagos', 'total', 'inscripcion'));
        } else {
            return redirect()->to('/');
        }
    }
}    
