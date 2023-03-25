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
        $data = DB::table('notifications')
            ->join('users', 'users.id', '=', 'notifications.user_id')
            ->join('publications', 'publications.id', '=', 'notifications.publication_id')
            ->join('likes', 'likes.id', '=', 'notifications.like_id')
            // ->join('shares', 'shares.id', '=', 'notifications.share_id')
            ->join('messages', 'messages.id', '=', 'notifications.message_id')
            ->select('notifications.id AS id', 'users.username', 'users.avatar', 'messages.text as message', 'notifications.share_id AS share', 'notifications.like_id AS like', 'likes.date', 'messages.sentby_id', 'messages.sento_id')
            // ->where('tasks.budget_id', '=', '1')
            // ->orderBy('tasks.id')
            ->get();

        return response()->json($data);

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
