<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\Publication;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class followController extends Controller
{

    public function insert(Request $request)
    {

       $follow = new Follow;

        $follow->follower_id = Auth::user()->id;
        $follow->following_id = $request->idFollowing;

        $follow->save();

        $notification = new Notification;

        $notification->sentby_id = $follow->follower_id;
        $notification->sento_id = $follow->following_id;
        $notification->follow_id = $follow->id;

        $notification->save();

    }
    
    public function update(Request $request)
    {

        $follow = Follow::where('follower_id', Auth::user()->id)
            ->where('following_id', $request->idFollowing)
            ->first();
        //dd($request->idFollowing);

        $notification = Notification::where('sentby_id', Auth::user()->id)
            ->where('sento_id', $request->idFollowing)
            ->where('follow_id', $follow->id)
            ->first();	
            

        if ($notification) {
            $notification->delete();
        }if($follow){
            $follow->delete();
    }

    }

    //$resultado = User::where('username', '=', $user)->first();
    public function followersammount($user)
    {
        $ammount = Follow::selectRaw('COUNT(*) as followersammount')
            ->join('users', 'users.id', '=', 'follows.following_id')
            ->where('users.username', '=', $user)
            ->get();

        return $ammount;
    }


    public function followingammount($user)
    {
        $ammount = Follow::selectRaw('COUNT(*) as followingammount')
            ->join('users', 'users.id', '=', 'follows.follower_id')
            ->where('users.username', '=', $user)
            ->get();

        return $ammount;
    }

    public function publicacionsUser($user)
    {
        $ammount = Publication::selectRaw('COUNT(*) as publicationsammount')
            ->join('users', 'users.id', '=', 'publications.user_id')
            ->where('users.username', '=', $user)
            ->get();

        return $ammount;
    }
}