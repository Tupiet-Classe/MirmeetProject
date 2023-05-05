<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use App\Models\Like;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        } else {
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
        } else {
            $user = User::find($id);
            $user->update(['access' => 'yes']);
            return back()->with('success', 'Usuario aceptado con éxito');
        }
    }

    public function deny($id)
    {
        if (!auth()->user()->can('dashboard.validate.users')) {
            abort(403, 'No tienes permisos');
        } else {
            $user = User::find($id);
            $user->update(['access' => 'denied']);
            return back()->with('success', 'Usuario denegado con éxito');
        }
    }

    public function searchPending(Request $request)
    {
        $query = $request->input('search-pending');

        $pendingUsers = User::where(function ($q) use ($query) {
            $q->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%');
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
        } else {
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
        } else {
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
        } else {
            $users = User::where(function ($query) {
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
        } else {
            $user = User::find($id);
            $user->update(['access' => 'banned']);
            return back()->with('success', 'Usuario expulsado de la comunidad');
        }
    }

    public function unban($id)
    {
        if (!auth()->user()->can('dashboard.manage.users')) {
            abort(403, 'No tienes permisos');
        } else {
            $user = User::find($id);
            $user->update(['access' => 'yes']);
            return back()->with('success', 'Usuario desbaneado con éxito');
        }
    }

    public function searchManage(Request $request)
    {
        $query = $request->input('search-manage');

        $users = User::where(function ($q) use ($query) {
            $q->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%');
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
        } else {
            $users = User::where(function ($query) {
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
        } else {
            $user = User::find($id);
            $user->update(['verified' => 'yes']);
            return back()->with('success', 'Usuario verificado correctamente');
        }
    }
    public function unverify($id)
    {
        if (!auth()->user()->can('dashboard.verify.users')) {
            abort(403, 'No tienes permisos');
        } else {
            $user = User::find($id);
            $user->update(['verified' => 'no']);
            return back()->with('success', 'Usuario desverificado correctamente');
        }
    }

    public function searchVerify(Request $request)
    {
        $query = $request->input('search-verify');

        $users = User::where(function ($q) use ($query) {
            $q->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%');
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
        } else {
            $users = User::where(function ($query) {
                $query->where('role', '!=', 'admin');
            })->paginate(5);

            return view('login.roles_users', compact('users'));
        }
    }

    public function give($id)
    {
        if (!auth()->user()->can('dashboard.roles')) {
            abort(403, 'No tienes permisos');
        } else {
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
        } else {
            $user = User::find($id);
            $user->update(['role' => 'client']);
            $user->removeRole('moderator');
            return back()->with('success', 'Usuario desverificado correctamente');
        }
    }

    public function searchRole(Request $request)
    {
        $query = $request->input('search-role');

        $users = User::where(function ($q) use ($query) {
            $q->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%');
        })
            ->where('role', '!=', 'admin')
            ->where('access', '!=', 'banned')
            ->where('access', '!=', 'denied')
            ->paginate(5);

        return view('login.roles_users', compact('users'));
    }


    // ---------------------------
    //
    //        Search Users
    //
    // --------------------------- 

    public function searchUsers(Request $request)
    {
        $query = $request->input('username');

        if (empty($query)) {
            return response()->json(['error' => 'La búsqueda está vacía']);
        }

        $users = User::where(function ($q) use ($query) {
            $q->where('username', 'LIKE', '%' . $query . '%')
                ->orWhere('name', 'LIKE', '%' . $query . '%');
        })->get();

        return response()->json(['users' => $users, 'query' => $query]);
    }



    public function showSearchResults(Request $request)
    {
        $query = $request->input('query');

        $users = User::where(function ($q) use ($query) {
            $q->where('username', 'LIKE', '%' . $query . '%')
                ->orWhere('name', 'LIKE', '%' . $query . '%');
        })->get();

        if ($users->isEmpty()) {
            $message = 'No hay resultados para "' . $query . '"';
        } else {
            $message = '';
        }

        return view('search.index', compact('users', 'message'));
    }

    public function searchUsersResponsive(Request $request)
    {
        $request->validate([
            'username' => 'required'
        ], [
            'username.required' => 'La búsqueda está vacía'
        ]);

        $query = $request->input('username');

        $users = User::where(function ($q) use ($query) {
            $q->where('username', 'LIKE', '%' . $query . '%')
                ->orWhere('name', 'LIKE', '%' . $query . '%');
        })->get();

        if ($request->session()->has('errors')) {
            $error = $request->session()->get('errors')->first();
            return response()->json(['error' => $error]);
        }else{
            return view('search.indexResponsive', compact('users'));
        }
    }





    // ---------------------------
    //
    //         Followers
    //
    // ---------------------------

    

    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })
            ->paginate(10);

        return view('users.index', compact('users', 'search'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'dni' => 'required|max:255',
            'phone' => 'required|max:255',
            'birthdate' => 'required|date|max:255',
            'role' => ['required', 'in:admin,client,moderator'],
            'password' => 'required|min:8',
        ]);

        $userData = $request->only('name', 'username', 'email', 'dni', 'phone', 'birthdate', 'role');
        $userData['password'] = Hash::make($request->input('password'));

        User::create($userData);

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'dni' => 'required|max:255',
            'phone' => 'required|max:255',
            'birthdate' => 'required|date|max:255',
            'role' => ['required', 'in:admin,client,moderator'],
            'password' => 'sometimes|required|min:8|confirmed', // La contraseña es opcional, pero si se proporciona, debe tener al menos 8 caracteres y coincidir con la confirmación
        ]);

        $userData = $request->only('name', 'username', 'email', 'dni', 'phone', 'birthdate', 'role');

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->input('password'));
        }

        $user->update($userData);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }

    public function likes(Request $request, Like $like, Notification $notification)
    {
        $userliked = $request->id;
        $postliked = $request->post;

        $likedYet = DB::table('notifications')
            ->join('publications', 'publications.id', '=', 'notifications.publication_id')
            ->join('likes', 'likes.id', '=', 'notifications.like_id')
            ->join('users', 'users.id', '=', 'notifications.sentby_id')
            ->select('like_id', 'notifications.id')
            ->where('notifications.publication_id', '=', $postliked)
            ->where('notifications.sentby_id', '=', auth()->user()->id)
            ->get();

        $likedYet = json_encode($likedYet);

        if ($likedYet == '[]') {

            $like = new Like;
            $like->date = now();
            $like->publication_id = $postliked;
            $like->hidden = null;
            $like->created_at = now();
            $like->updated_at = now();

            $like->save();

            $notification = new Notification;
            $notification->message_id = null;
            $notification->share_id = null;
            $notification->like_id = $like->id;
            $notification->sentby_id = auth()->user()->id;
            $notification->sento_id = $userliked;
            $notification->publication_id = $postliked;
            $notification->hidden = null;
            $notification->created_at = now();
            $notification->updated_at = now();

            $notification->save();

            $data = "OK";

            return response()->json($data);
        } else {

            $likeData = json_decode($likedYet);
            $quitLike = $likeData[0]->like_id;

            $notifyData = json_decode($likedYet);
            $quitNotify = $notifyData[0]->id;

            DB::table('notifications')
                ->where('id', '=', $quitNotify)
                ->delete();

            DB::table('likes')
                ->where('id', '=', $quitLike)
                ->delete();

            $data = "Deleted OK";

            return response()->json($data);
        }
    }

    public function checkLikes(Request $request)
    {
        $postliked = $request->post;

        $likedYet = DB::table('notifications')
            ->join('publications', 'publications.id', '=', 'notifications.publication_id')
            ->join('likes', 'likes.id', '=', 'notifications.like_id')
            ->join('users', 'users.id', '=', 'notifications.sentby_id')
            ->select('like_id', 'notifications.id')
            ->where('notifications.publication_id', '=', $postliked)
            ->where('notifications.sentby_id', '=', auth()->user()->id)
            ->get();

        $likedYet = json_encode($likedYet);

        if ($likedYet == '[]') {
            $data = "No Likes";
            return response()->json($data);
        }else {
            $data = "Liked";
            return response()->json($data);
        }
    }
}
