<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use App\Models\Message;
use App\Models\Like;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // -------------------------------------
    //
    //     Agafar Comentaris del Vue
    //
    // -------------------------------------

   
    public function storeComment(Request $request, $id)
{
    // Validar les dades del formulari
    $request->validate([
        'text' => 'required|max:255',
    ]);

    // Crear nou comentari
    $comment = new Message();
    $comment->text = $request->text;
    $comment->user_id = auth()->user()->id; // Assignar el ID de l'usuari autenticat
    $comment->message_id = $id;
    $comment->save();

    // Tornar una resposta en format JSON
    return response()->json(['message' => 'Comment created successfully!']);
}

}
