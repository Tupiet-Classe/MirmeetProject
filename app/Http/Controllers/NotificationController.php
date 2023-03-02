<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificacioRequest;
use App\Http\Requests\UpdateNotificacioRequest;
use App\Models\Notificacio;

class NotificacioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNotificacioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotificacioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notificacio  $notificacio
     * @return \Illuminate\Http\Response
     */
    public function show(Notificacio $notificacio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notificacio  $notificacio
     * @return \Illuminate\Http\Response
     */
    public function edit(Notificacio $notificacio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotificacioRequest  $request
     * @param  \App\Models\Notificacio  $notificacio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotificacioRequest $request, Notificacio $notificacio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notificacio  $notificacio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notificacio $notificacio)
    {
        //
    }
}
