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
        $pendingUsers = User::where('access', 'no')->paginate(5);

        return view('login.pending_users', compact('pendingUsers'));
    }

    public function allow($id)
    {
        $user = User::find($id);
        $user->update(['access' => 'yes']);
        return back()->with('success', 'Usuario aceptado con éxito');
    }

    public function deny($id)
    {
        $user = User::find($id);
        $user->update(['access' => 'denied']);
        return back()->with('success', 'Usuario denegado con éxito');
    }

    // ------------------------
    //
    //     Show Denied Users
    //
    // ------------------------

    public function indexDenied()
    {
        $deniedUsers = User::where('access', 'denied')->paginate(5);

        return view('login.denied_users', compact('deniedUsers'));
    }

    public function restore($id)
    {
        $user = User::find($id);
        $user->update(['access' => 'yes']);
        return back()->with('success', 'Usuario restaurado con éxito');
    }

    // ---------------------------
    //
    //         Banned Users
    //
    // ---------------------------

    public function indexBanned()
    {
        $users = User::where(function($query) {
            $query->where('access', 'yes')
                ->orWhere('access', 'banned');
        })
            ->where('role', '!=', 'admin') // Excluir al usuario administrador por defecto
            ->paginate(5);

        return view('login.ban_users', compact('users'));
    }

    public function ban($id)
    {
        $user = User::find($id);
        $user->update(['access' => 'banned']);
        return back()->with('success', 'Usuario expulsado de la comunidad');
    }

    public function unban($id)
    {
        $user = User::find($id);
        $user->update(['access' => 'yes']);
        return back()->with('success', 'Usuario desbaneado con éxito');
    }

    // ---------------------------
    //
    //         Verify Users
    //
    // ---------------------------

    public function indexVerify()
    {
        $users = User::where(function($query) {
            $query->where('verified', 'no')
                ->orWhere('verified', 'yes');
        })
            ->where('role', '!=', 'admin') // Excluir al usuario administrador por defecto
            ->paginate(5);

        return view('login.verify_users', compact('users'));
    }

    public function verify($id)
    {
        $user = User::find($id);
        $user->update(['verified' => 'yes']);
        return back()->with('success', 'Usuario verificado correctamente');
    }
    public function unverify($id)
    {
        $user = User::find($id);
        $user->update(['verified' => 'no']);
        return back()->with('success', 'Usuario desverificado correctamente');
    }



}
