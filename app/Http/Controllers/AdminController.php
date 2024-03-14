<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\controllers\QueryException;
use Illuminate\Http\Request;
use App\Models\Inscripcione;
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
