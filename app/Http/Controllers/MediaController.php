<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store files to filesystem storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['file' => ['required', 'file']]);

        $path = $request->file('file')->store('/uploads', 'public');

        $url = Storage::disk('public')->url($path);

        return response()->json(['data' => compact('path', 'url')], 201);
    }
}
