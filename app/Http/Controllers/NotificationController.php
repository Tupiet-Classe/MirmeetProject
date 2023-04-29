<?php

namespace App\Http\Controllers;

use App\Models\Notificacio;
use App\Http\Controllers\PublicationController;
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
            ->join('users', 'users.id', '=', 'notifications.sento_id')
            ->join('publications', 'publications.id', '=', 'notifications.publication_id')
            ->select('notifications.id AS id', 'publications.ref_swarm AS avatar', 'notifications.message_id as message', 'notifications.follow_id AS follow', 'notifications.share_id AS share', 'notifications.like_id AS like', 'notifications.created_at AS date')
            ->where('notifications.sento_id', '=', auth()->user()->id)
            ->get();

        $encriptionKey = '';
        foreach ($data as $references) {
            $arrayRef = array(
                'reference' => $references->avatar,
                'encryptionKey' => $encriptionKey
            );
            $res = new PublicationController;
            $response = $res->getFromSwarm($references->avatar);
            $posts[] = ['data' => $response];
        } 
        
        $username = DB::table('notifications')
        ->join('users', 'users.id', '=', 'notifications.sentby_id')
        ->select('users.username')
        ->whereColumn('users.id', '=', 'notifications.sentby_id')
        ->where('notifications.sento_id', '=', auth()->user()->id)
        ->get();


        $resultado = [
            'username' => $username,
            'data' => $data,
            'posts' => $posts
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
