<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Publication::all()->where('user_id', '=', 1);
    }

    public function get_posts() {
        return Publication::all()->where('user_id', '=', 1);
        $data = [];
        return Http::get('http://insertgenerator.tk', ['reference' => 'ujhygtrfes' ]);
        // foreach ($posts as $key => $post) {
        //     $data[$key] = $post;
        //     $request = ['reference' => $post->comment];
        //     $comment = Http::get('http://localhost/api');
        //     return $comment->body();
        // }
        // return $data;
    }

    // Aquest mètode intenta simular el que faria l'api de MirMeet
    public function get_data_from_reference(Request $request) {
        if ( is_null($request->reference) ) return 'no';
        $data = [
            'ujhygtrfes' => 'image1',
            'sertfyhuiolp' => 'image2',
            'gtfr' => 'This is a post!',
            'rftgyujiolp' => 'Post amazing!',
            'esdrfgyjkl' => 'base64:/gyhuji'
        ];
        return $data[$request->reference];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Publication();
        $post->image = $request->input('image');
        $post->comment = $request->input('comment');
        $post->user_id = $request->input('user_id');
        $post->save();
    }

    public function myWall()
    {
        $user_id = 1; // Aquí anirà la ID de la sessió
        
        $data = DB::table('publications')
        ->join('users', 'publications.user_id', '=', 'users.id')
        ->select('users.username', 'publications.ref_swarm')
        ->where('publications.user_id', $user_id)
        ->get();

        $encriptionKey = '';

        foreach ($data as $references) {
            $arrayRef = array(
                'reference' => $references->ref_swarm,
                'encryptionKey' => $encriptionKey
            );
            $response = PublicationController::recDataSwarm($arrayRef);
            $posts[] = ['data' => $response, 'user'=>$references->username];
        } 
        return json_encode($posts);
    }

    public static function recDataSwarm($ref)
    {
            $url = 'https://videowiki-dcom.mirmit.es/api/retrieveDraft';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($ref));
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            return $response; 
    }

    
    
    
    
}
