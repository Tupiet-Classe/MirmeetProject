<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ApiFake;

class ApiFakeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $request->input('content');

        if (!is_string($content)) {
            return response()->json([
                'error' => 'Invalid input. Please provide text content only.'
            ], 400);
        }

        $api = new ApiFake();
        $api->content = $content;
        $api->save();

        return response()->json([
            'reference' => $api->id
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = ApiFake::where('id', $id)->first();

        if (!$content) {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }

        $url = $content->content;

        return response()->json([
            'content' => $url
        ]);
    }


}
