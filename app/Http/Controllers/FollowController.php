<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;

class followController extends Controller
{

    public function insert(Request $request)
    {

       $follow = new Follow;

        $follow->follower_id = $request->idFollower;
        $follow->following_id = $request->idFollowing;

        $follow->save();

    }
    
    public function update(Request $request)
    {

     

        $linea = Follow::where('follower_id', $request->idFollower)
                        ->where('following_id', $request->idFollowing)
                        ->first();

        if ($linea) {
            $linea->delete();
        }

    }
}