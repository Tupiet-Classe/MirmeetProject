<?php

namespace App\Http\Controllers;

use App\Models\Notificacio;
use App\Models\Notification;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function index()
    {
    }


    public function store()
    {
    }


    public function show(Notification $notificacio)
    {

        $username = DB::table('notifications')
            ->join('users', 'users.id', '=', 'notifications.sentby_id')
            ->select('users.username')
            ->whereColumn('users.id', '=', 'notifications.sentby_id')
            ->get();

        $data = DB::table('notifications')
            ->join('users', 'users.id', '=', 'notifications.sento_id')
            ->join('publications', 'publications.id', '=', 'notifications.publication_id')
            ->select('notifications.id AS id', 'users.username', 'publications.ref_swarm AS avatar', 'notifications.message_id as message', 'notifications.share_id AS share', 'notifications.like_id AS like', 'notifications.created_at AS date')
            ->where('users.id', '=', auth()->user()->id)
            ->get();

        $resultado = [
            'username' => $username,
            'data' => $data,
        ];

        return response()->json($resultado);
    }


    public function edit(Notification $notificacio)
    {
    }


    public function update(Request $request, Notification $notificacio)
    {
    }


    public function destroy(Notification $notificacio)
    {
    }
}
