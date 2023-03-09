<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // -------------------------------------
    //
    //     Show Pending Registration Users
    //
    // -------------------------------------

    public function indexPending()
    {
        if (!auth()->user()->can('dashboard.validate.records')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $pendingUsers = User::where('access', 'no')->paginate(5);

            return view('login.pending_users', compact('pendingUsers'));
        }
    }

    public function allow($id)
    {
        if (!auth()->user()->can('dashboard.validate.records')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $user = User::find($id);
            $user->update(['access' => 'yes']);
            return back()->with('success', 'Usuario aceptado con éxito');
        }
    }

    public function deny($id)
    {
        if (!auth()->user()->can('dashboard.validate.records')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $user = User::find($id);
            $user->update(['access' => 'denied']);
            return back()->with('success', 'Usuario denegado con éxito');
        }
    }

    // ------------------------
    //
    //     Show Denied Users
    //
    // ------------------------

    public function indexDenied()
    {
        if (!auth()->user()->can('dashboard.validate.records.denied')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $deniedUsers = User::where('access', 'denied')->paginate(5);

            return view('login.denied_users', compact('deniedUsers'));
        }
    }

    public function restore($id)
    {
        if (!auth()->user()->can('dashboard.validate.records.denied')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $user = User::find($id);
            $user->update(['access' => 'yes']);
            return back()->with('success', 'Usuario restaurado con éxito');
        }
    }

    // ---------------------------
    //
    //         Banned Users
    //
    // ---------------------------

    public function indexBanned()
    {
        if (!auth()->user()->can('dashboard.manage.users')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $users = User::where(function($query) {
                $query->where('access', 'yes')
                    ->orWhere('access', 'banned');
            })
                ->where('role', '!=', 'admin') // Excluir al usuario administrador por defecto
                ->paginate(5);

            return view('login.ban_users', compact('users'));
        }
    }

    public function ban($id)
    {
        if (!auth()->user()->can('dashboard.manage.users')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $user = User::find($id);
            $user->update(['access' => 'banned']);
            return back()->with('success', 'Usuario expulsado de la comunidad');
        }
    }

    public function unban($id)
    {
        if (!auth()->user()->can('dashboard.manage.users')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $user = User::find($id);
            $user->update(['access' => 'yes']);
            return back()->with('success', 'Usuario desbaneado con éxito');
        }
    }

    // ---------------------------
    //
    //         Verify Users
    //
    // ---------------------------

    public function indexVerify()
    {
        if (!auth()->user()->can('dashboard.verify.users')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $users = User::where(function($query) {
                $query->where('verified', 'no')
                    ->orWhere('verified', 'yes');
            })
                ->where('role', '!=', 'admin') // Excluir al usuario administrador por defecto
                ->paginate(5);

            return view('login.verify_users', compact('users'));
        }
    }

    public function verify($id)
    {
        if (!auth()->user()->can('dashboard.verify.users')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $user = User::find($id);
            $user->update(['verified' => 'yes']);
            return back()->with('success', 'Usuario verificado correctamente');
        }
    }
    public function unverify($id)
    {
        if (!auth()->user()->can('dashboard.verify.users')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $user = User::find($id);
            $user->update(['verified' => 'no']);
            return back()->with('success', 'Usuario desverificado correctamente');
        }
    }



}
