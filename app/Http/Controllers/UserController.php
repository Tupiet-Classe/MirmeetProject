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
        if (!auth()->user()->can('dashboard.validate.users')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $pendingUsers = User::where('access', 'no')
                ->where('role', '!=', 'admin')
                ->where('role', '!=', 'moderator')
                ->paginate(5);

            return view('login.pending_users', compact('pendingUsers'));
        }
    }

    public function allow($id)
    {
        if (!auth()->user()->can('dashboard.validate.users')) {
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
        if (!auth()->user()->can('dashboard.validate.users')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $user = User::find($id);
            $user->update(['access' => 'denied']);
            return back()->with('success', 'Usuario denegado con éxito');
        }
    }

    public function searchPending(Request $request)
    {
        $query = $request->input('search-pending');

        $pendingUsers = User::where(function($q) use ($query) {
            $q->where('name', 'LIKE', '%'.$query.'%')
                ->orWhere('email', 'LIKE', '%'.$query.'%');
        })
            ->where('access', '!=', 'denied')
            ->where('role', '!=', 'admin')
            ->where('role', '!=', 'moderator')
            ->paginate(5);

        return view('login.pending_users', compact('pendingUsers'));
    }

    // ------------------------
    //
    //     Show Denied Users
    //
    // ------------------------

    public function indexDenied()
    {
        if (!auth()->user()->can('dashboard.validate.users.restore')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $deniedUsers = User::where('access', 'denied')
                ->where('role', '!=', 'admin')
                ->where('role', '!=', 'moderator')
                ->paginate(5);

            return view('login.denied_users', compact('deniedUsers'));
        }
    }

    public function restore($id)
    {
        if (!auth()->user()->can('dashboard.validate.users.restore')) {
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
                ->where('role', '!=', 'admin')
                ->where('role', '!=', 'moderator')
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

    public function searchManage(Request $request)
    {
        $query = $request->input('search-manage');

        $users = User::where(function($q) use ($query) {
            $q->where('name', 'LIKE', '%'.$query.'%')
                ->orWhere('email', 'LIKE', '%'.$query.'%');
        })
            ->where('role', '!=', 'admin')
            ->where('role', '!=', 'moderator')
            ->paginate(5);

        return view('login.ban_users', compact('users'));
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
                ->where('role', '!=', 'admin')
                ->where('role', '!=', 'moderator')
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

    public function searchVerify(Request $request)
    {
        $query = $request->input('search-verify');

        $users = User::where(function($q) use ($query) {
            $q->where('name', 'LIKE', '%'.$query.'%')
                ->orWhere('email', 'LIKE', '%'.$query.'%');
        })
            ->where('role', '!=', 'admin')
            ->where('role', '!=', 'moderator')
            ->paginate(5);

        return view('login.verify_users', compact('users'));
    }

    // ---------------------------
    //
    //         Roles Users
    //
    // ---------------------------

    public function indexRole()
    {
        if (!auth()->user()->can('dashboard.roles')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $users = User::where(function($query) {
                $query->where('role', '!=', 'admin');
            })->paginate(5);

            return view('login.roles_users', compact('users'));
        }
    }

    public function give($id)
    {
        if (!auth()->user()->can('dashboard.roles')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $user = User::find($id);
            $user->update(['role' => 'moderator']);
            $user->assignRole('moderator');
            return back()->with('success', 'Usuario verificado correctamente');
        }
    }
    public function remove($id)
    {
        if (!auth()->user()->can('dashboard.roles')) {
            abort(403, 'No tienes permisos');
        }
        else{
            $user = User::find($id);
            $user->update(['role' => 'client']);
            $user->removeRole('moderator');
            return back()->with('success', 'Usuario desverificado correctamente');
        }
    }

    public function searchRole(Request $request)
    {
        $query = $request->input('search-role');

        $users = User::where(function($q) use ($query) {
            $q->where('name', 'LIKE', '%'.$query.'%')
                ->orWhere('email', 'LIKE', '%'.$query.'%');
        })
            ->where('role', '!=', 'admin')
            ->where('access', '!=', 'banned')
            ->where('access', '!=', 'denied')
            ->paginate(5);

        return view('login.roles_users', compact('users'));
    }

    
    // ---------------------------
    //
    //         Followers
    //
    // ---------------------------

    public function followersammount($id)
    {
        $ammount = Follow::selectRaw('COUNT(*) as followersammount')
        ->where('follows.following_id', '=', $id)
        ->get();

        return $ammount;
    }


    public function followingammount($id)
    {
        $ammount = Follow::selectRaw('COUNT(*) as followersammount')
        ->where('follows.follower_id', '=', $id)
        ->get();

        return $ammount;
    }



}
