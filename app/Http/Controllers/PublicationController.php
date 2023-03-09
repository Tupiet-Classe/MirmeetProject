<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
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

    public function store_image(Request $request)
    {
        $image = $request->file('image');

        $ruta = $image->store('public/img/tmp');

        return $ruta;
    }
    public function store_posts(Request $request)
    {
        $ruta = $request->path;

        $data = [
            'text' => $request->text,
            'image' => base64_encode(file_get_contents($ruta)),
            'key' => ''
        ];
        $response = Http::post('https://videowiki-dcom.mirmit.es/api/saveDraft', $data);

        if ($response->ok()) {
            // Solicitud exitosa
        } else {
            // Error en la solicitud
            $body = $response->json();
            if (isset($body['error'])) {
                // Mostrar mensaje de error
            }
        }

        if (file_exists($ruta)) {
            unlink($ruta);
        }
        
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
}
