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
}
