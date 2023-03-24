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

        return Notification::all();

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
