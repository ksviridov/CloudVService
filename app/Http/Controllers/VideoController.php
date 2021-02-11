<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Aws\Rekognition\RekognitionClient;

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
            'path' => $tf,
            'job_id' => '',
            'check_result' => '',
        ]);


        $videoCheckResult = $video->startVideoCheck();

        return redirect('add')->with([
            'message' => $videoCheckResult,
            'name' => $video->name
        ]);

    }

    public function result(){
        return view('result');
    }

    public function getCheckResult(Request $request){
        $video = Video::where('name', '=', $request->name)->get()->first();
        if ($video->check_result == ''){
            $result = substr(Video::getResult($video->job_id), strpos(Video::getResult($video->job_id), '{'));

            $video->check_result = json_decode($result, true);
            $video->save();
        }


        return $video->check_result;

    }


}
