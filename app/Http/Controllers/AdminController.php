<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\controllers\QueryException;
use Illuminate\Http\Request;
use App\Models\usere;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function usuarios()
    {
        if (Auth::check()) {
            $usuarios = User::all();
            return view::make('admin.index', compact('usuarios'));
        } else {
            return redirect()->to('/');
        }
    }

    public function create()
    {
        if (Auth::check()) {
            return view::make('admin.create');
        } else {
            return redirect()->to('/');
        }
    }

    public function asignarRolEdit($id)
    {
        if (Auth::check()) {
            $user = User::find($id);
            $roles = Role::all(); // trae todos los roles que se hayan creado para poder asignar
            return view::make('admin.UserPermiso', compact('user', 'roles'));
        } else {
            return redirect()->to('/');
        }
    }

    public function eliminarUsuario($id)
    {
        if (Auth::check()) {
            try {
                DB::beginTransaction();
                $user = User::findOrFail($id);
                $user->estado = 0;
                // dd( $user );
                $user->save();

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

    // public function asignarRolGuardar(Request $request, $id)
    // {
    //     if (Auth::check()) {
    //         $user = User::find($id);
    //         $user->role()->sync($request->roles); // trae todos los roles que se hayan creado para poder asignar
    //         // return view::make('admin.UserPermiso', compact('user', 'roles'));
    //     } else {
    //         return redirect()->to('/');
    //     }
    // }
}
