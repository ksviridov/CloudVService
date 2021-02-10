<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{

    public function add(){
        return view('add');
    }

    public function saveToS3(Request $request){
        $tf = $request->file('video')->store('videos', 's3');

        $path = Storage::url($tf);


        $video = Video::create([
            'name' => basename($tf),
            'path' => Storage::disk('s3')->path($path),
            'info' => ''
        ]);


    }

}
