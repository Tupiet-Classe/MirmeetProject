<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Events\StartChat;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ChatController extends Controller
{

    public $channels;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chat');
    }

    public function prepare() {
        return view('before');
    }

    private function get_pusher() {
        return new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
            'host' => env('PUSHER_HOST'),
            'port' => env('PUSHER_PORT'),
            'scheme' => env('PUSHER_SCHEME'),
            'encrypted' => false,
            'useTLS' => false,
        ]);
    }

    public function get_channels() {
        $pusher = $this->get_pusher();
        return $pusher->get('/channels');
        return $this->channels;
    }

    /**
     * Aquest mètode retorna, si existeix, el token entre dos usuaris.
     * Si no existeix, retorna null
     */
    private function check_existing_room($other_id) {
        $room = Room::where([
            ['start_user', Auth::id()],
            ['end_user', $other_id]
        ])
        ->orWhere([
            ['start_user', $other_id],
            ['end_user', Auth::id()]
        ])
        ->first();
        return $room->token ?? null;
    }


    /**
     * Aquest mètode s'executa quan un usuari vol iniciar un xat amb un altre usuari.
     * Crea un token, que serà la id de la sala, i emet l'event StartChat a l'usuari desitjat.
     * Finalment, retorna a l'usuari el token de la sala.
     */
    public function start_chat($to_id) {
        $original_token = $this->check_existing_room($to_id);
        if ($original_token) {
            StartChat::dispatch($original_token, $to_id);
            return ['token' => $original_token];
        }
        $token = Str::random(16);
        Room::create([
            'token' => $token,
            'start_user' => Auth::id(),
            'end_user' => $to_id
        ]);
        StartChat::dispatch($token, $to_id);
        return ['token' => $token];
    }

    /**
     * Aquest mètode retorna la id de l'usuari que rebrà el missatge
     */
    private function get_reciever($token) {
        // Agafem els usuaris de la sala actual
        $users_in_room = Room::where('token', $token)->select(['start_user', 'end_user'])->first();

        // Recuperem la id de l'usuari a qui li hem enviat el missatge
        return  $users_in_room->start_user == Auth::id() 
                    ? $users_in_room->end_user 
                    : $users_in_room->start_user;
    }

    /**
     * Aquest mètode s'executarà quan s'intenti enviar un missatge
     */
    public function send(Request $request) {
        // Recuperem la instància de Pusher
        $pusher = $this->get_pusher();
        //! Pusher sempre afegeix "presence-" al davant, SÍ QUE CAL posar-ho aquí 
        //$users = $pusher->getPresenceUsers('presence-chat-between.' . $request->token);

        // Recuperem l'usuari a qui li enviarem el missatge
        $receiver = $this->get_reciever($request->token);

        // Guardem el missatge a la base de dades
        Message::create([
            'sentby_id' => Auth::id(),
            'sento_id' => $receiver,
            'text' => $request->message
        ]);

        // Emitim l'event NewMessage
        NewMessage::dispatch($request->message, $request->token);
        return true;
    }

    /**
     * Aquest mètode retorna, donada la id de l'altre usuari, 
     * els missatges que hi ha hagut entre ell i qui ha fet la petició
     */
    public function get_messages_between($token) {
        $other_id = $this->get_reciever($token);
        $messages = Message::where([
            ['sentby_id', Auth::id()],
            ['sento_id', $other_id]
        ])
        ->orWhere([
            ['sentby_id', $other_id],
            ['sento_id', Auth::id()]
        ])
        ->get();
        
        $messagesToSend = [];

        foreach ($messages as $key => $message) {
            $messagesToSend[] = [
                'sender' => $message->sender->username, 
                'reciever' => $message->recipient->username,
                'text' => $message->text
            ];
        }

        echo json_encode($messagesToSend);
    }
}
