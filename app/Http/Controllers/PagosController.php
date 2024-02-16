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

class PagosController extends Controller
{
    public function formulario($id)
    {
        if (Auth::check()) {
            $inscripcion = Inscripcione::find($id);
            return view::make('pagos.altaPagos', compact('inscripcion'));
        } else {
            return redirect()->to('/');
        }
    }
}
