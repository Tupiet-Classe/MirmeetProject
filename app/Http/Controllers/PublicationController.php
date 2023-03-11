<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
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

    public function store_posts(Request $request, Publication $post)
    {
        $file = $request->file('file');
        $text = $request->input('text');

        $response = 0;

        $data = [
            'encrypted' => false,
            'data' =>
            [
                'text' => $text,
                'image' => base64_encode($file),
                'key' => ''
            ]
        ];
        $response = Http::post('https://videowiki-dcom.mirmit.es/api/saveDraft', $data);

        $datajson = json_decode($response);

        $ref = $datajson->reference;

        $post->user_id = 1;
        $post->ref_swarm = $ref;
        $post->save();

        return $response;
    }

    // Aquest mètode intenta simular el que faria l'api de MirMeet
    public function get_data_from_reference(Request $request)
    {
        if (is_null($request->reference)) return 'no';
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
            ->where('user_id', $user_id)
            ->get();

        $encriptionKey = '';
        $arrayRef = array();

        foreach ($data as $references) {
            $arrayRef[] = array(
                'reference' => $references->ref_swarm,
                'encryptionKey' => $encriptionKey
            );
        }
        PublicationController::recDataSwarm($arrayRef);
    }

    public static function recDataSwarm($arrayRef)
    {
        foreach ($arrayRef as $ref) {
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
            echo($response);
        }
    }
}
