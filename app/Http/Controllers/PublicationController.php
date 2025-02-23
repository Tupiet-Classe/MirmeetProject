<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function filterNotFollowed(){
        //Preparar seqüència SQL on filtro a base d'inner joins les publicacions
        
     }
    

     public function index()
    {
        return Publication::all()->where('user_id', '=', 1);
    }

    public function store_posts(Request $request)
    {
        $file = $request->input('file');
        $text = $request->input('text');

        $data = [
            'text' => $text,
            'image' => $file
        ];
        
        return $data;
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

    public function GetPosts($follower_id)
    {
        $publications = Publication::select(
            'publications.ref_swarm',
            'users.id',
            'users.username',
            'users.avatar',
            DB::raw('COUNT(likes.id) as Magrada'),
            DB::raw('COUNT(DISTINCT shares.publication_id) as compartit'),
            'publications.created_at'
        )
            ->join('users', 'publications.user_id', '=', 'users.id')
            ->leftJoin('likes', 'publications.publication_id', '=', 'likes.publication_id')
            ->leftJoin('shares', 'publications.publication_id', '=', 'shares.publication_id')
            ->join('follows', 'users.id', '=', 'follows.following_id')
            ->where('follows.follower_id', $follower_id)
            ->groupBy('publications.ref_swarm', 'users.id', 'users.avatar', 'users.username', 'publications.created_at')
            ->get();

            foreach ($publications as $publication) {
                $publication->save();
            }
            return response()->json(['publications' => $publications]);

        }

        public function GetPosts3()
{
    $follower_id = auth()->id();

    $publications = Publication::select(
            'publications.ref_swarm',
            'users.id',
            'users.username',
            'users.avatar',
            DB::raw('COUNT(likes.id) as Magrada'),
            DB::raw('COUNT(DISTINCT shares.publication_id) as compartit'),
            'publications.created_at'
        )
        ->join('users', 'publications.user_id', '=', 'users.id')
        ->leftJoin('likes', 'publications.publication_id', '=', 'likes.publication_id')
        ->leftJoin('shares', 'publications.publication_id', '=', 'shares.publication_id')
        ->join('follows', 'users.id', '=', 'follows.following_id')
        ->where('follows.follower_id', $follower_id)
        ->groupBy('publications.ref_swarm', 'users.id', 'users.avatar', 'users.username', 'publications.created_at')
        ->get();

    foreach ($publications as $publication) {
        $publication->save();
    }

    return ['publications' => $publications->toArray()];
}


        public function GetAllPosts2()
        {
            return Publication::select(
                'publications.ref_swarm',
                'users.id',
                'users.username',
                'users.avatar',
                DB::raw('COUNT(likes.id) as Magrada'),
                DB::raw('COUNT(DISTINCT shares.publication_id) as compartit'),
                'publications.created_at'
              )
                ->join('users', 'publications.user_id', '=', 'users.id')
                ->leftJoin('likes', 'publications.publication_id', '=', 'likes.publication_id')
                ->leftJoin('shares', 'publications.publication_id', '=', 'shares.publication_id')
                ->join('follows', 'users.id', '=', 'follows.following_id')
                ->where('follows.follower_id', '=', Auth::user()->id)
                ->groupBy('publications.publication_id', 'publications.ref_swarm', 'users.id', 'users.username', 'users.avatar', 'publications.created_at')
                ->orderBy('publications.created_at', 'desc')
                ->paginate(10)
                ->toJson();
              
            }            
    


    public function postsHome()
    {
        $user_id = Auth::user()->id;

        $data = DB::table('publications')
            ->join('users', 'publications.user_id', '=', 'users.id')
            ->join('follows', 'follows.following_id', '=', 'publications.user_id')
            ->select('users.id AS id_user', 'publications.id AS post_id', 'users.username', 'users.avatar AS profile', 'publications.ref_swarm', 'publications.created_at AS date')
            ->where('follows.follower_id', $user_id)
            ->orderBy('publications.created_at', 'desc')
            ->get();
        
            $encriptionKey = '';
        
            foreach ($data as $references) {
    
                $fetxa = Carbon::createFromFormat('Y-m-d H:i:s', $references->date);
                $fetxaFormatada = $fetxa->format('d-m-Y');
            
                $arrayRef = array(
                    'reference' => $references->ref_swarm,
                    'encryptionKey' => $encriptionKey
                );
                
                $response = PublicationController::getFromSwarm($references->ref_swarm);
                $posts[] = ['data' => $response, 'post'=>$references->post_id, 'id_user'=>$references->id_user, 'profile'=>$references->profile, 'user'=>$references->username, 'date'=>$references->date];
            } 
            return $posts;        
    }

    public function postsDiscover()
    {
        $user_id = Auth::user()->id;

        $data = DB::table('publications')
            ->join('users', 'publications.user_id', '=', 'users.id')
            ->leftJoin('follows', 'follows.following_id', '=', 'publications.user_id')
            ->select('users.id AS id_user', 'publications.id AS post_id', 'users.username', 'users.avatar AS profile', 'publications.ref_swarm', 'publications.created_at AS date')
            ->whereNull('follows.follower_id')
            ->orWhere('follows.follower_id', '<>', $user_id)
            ->where('publications.user_id', '<>', $user_id)
            ->orderBy('publications.created_at', 'desc')
            ->get();
        
            $encriptionKey = '';
        
            foreach ($data as $references) {
    
                $fetxa = Carbon::createFromFormat('Y-m-d H:i:s', $references->date);
                $fetxaFormatada = $fetxa->format('d-m-Y');
            
                $arrayRef = array(
                    'reference' => $references->ref_swarm,
                    'encryptionKey' => $encriptionKey
                );
                
                $response = PublicationController::getFromSwarm($references->ref_swarm);
                $posts[] = ['data' => $response, 'post'=>$references->post_id, 'id_user'=>$references->id_user, 'profile'=>$references->profile, 'user'=>$references->username, 'date'=>$references->date];
            } 
            return $posts;        
    }
    
    public function myWall()
    {
        $user_id = Auth::user()->id;

        $data = DB::table('publications')
            ->join('users', 'publications.user_id', '=', 'users.id')
            ->select('users.id AS id_user', 'publications.id AS post_id', 'users.username', 'users.avatar AS profile', 'publications.ref_swarm', 'publications.created_at AS date')
            ->where('publications.user_id', $user_id)
            ->orderBy('publications.created_at', 'desc')
            ->get();


        $encriptionKey = '';


        foreach ($data as $references) {
            $arrayRef = array(
                'reference' => $references->ref_swarm,
                'encryptionKey' => $encriptionKey
            );
            $res = new PublicationController;
            $response = $res->getFromSwarm($references->ref_swarm);
            $posts[] = ['data' => $response, 'post'=>$references->post_id, 'id_user'=>$references->id_user, 'profile'=>$references->profile, 'user'=>$references->username, 'date'=>$references->date];
        } 
        return ($posts);
    }

    

    public function postToSwarm(Request $request, Publication $post) 
    {
        print("API funcional de veritat.");

        echo("<br><br>");

        $image = $request->input('image');
        $text = $request->input('coment');

        $url = 'https://download.gateway.ethswarm.org/bzz';
        
        $json = array(
            'image' => $image,
            'text' => $text
        );
    
        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($json));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        
        $response = curl_exec($curl);

        $datajson = json_decode($response);

        $ref = $datajson->reference;

        $post->user_id = Auth::user()->id; 
        $post->ref_swarm = $ref;
        $post->save();
        
        curl_close($curl);
    
        return $response;
    }
    
    public function getFromSwarm($hash) {
        
        $url = 'https://download.gateway.ethswarm.org/bzz/'.$hash.'/';
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
    
        $response = curl_exec($curl);
    
        curl_close($curl);

        return $response;  
    }
    
     // -------------------------------------
    //
    //     Agafar Comentaris del Vue
    //
    // -------------------------------------
    public function storeComment(Request $request, $id)
    {
        // Validar las datos del formulario
        $request->validate([
            'text' => 'required|max:255',
        ]);
    
        // Buscar la publicación correspondiente
        $publication = Publication::find($id);
    
        $comment = new Message();
        $comment->text = $request->text;
        $comment->sentby_id = auth()->user()->id;
        $comment->sento_id = $publication->user_id; // Agregar la ID del usuario que hizo la publicación
        $comment->publication_id = $publication->id; // Agregar la ID de la publicación al comentario
        $comment->save(); // Guardar el comentario en la base de datos
    
        // Redireccionar al usuario a la página de "discover"
        return redirect()->route('discover');
    }
    
     // -------------------------------------
    //
    //     Veure Comentaris del Vue
    //
    // -------------------------------------
    public function showComments($id)
{
    // Buscar la publicación correspondiente
    $publication = Publication::find($id);

    // Si no se encuentra la publicación, redirigir a una página de error o a donde prefieras
    if ($publication == null) {
        return redirect()->route('Algo ha anat mal...!');
    }

    // Obtener los comentarios de la publicación
    $comments = $publication->messages;


    // retornar una respuesta JSON:
    return response()->json($comments);
}

    }
    
