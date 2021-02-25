<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Aws\Rekognition\RekognitionClient;

class VideoController extends Controller
{

    public function moderation(){
        return view('moderation');
    }

    public function moderationResults(Request $request){
        $tf = $request->file('video')->store('videos', 's3');

        $video = Video::videoCreate($tf);

        $video->startModeration();

        $result = $video->getCheckResult('moderation');




//        return view('moderation')->with([
////            'message' => $videoCheckResult,
////            'name' => $video->name
//        ]);
        return $result;

    }


    public function label(){
        return view('label');
    }
    public function labelCheckResults(Request $request){
        $tf = $request->file('video')->store('videos', 's3');

        $video = Video::videoCreate($tf);

        $video->startLabelVideoCheck();

        $result = $video->getCheckResult('label');
//        $jobId = Video::
//        if ($request->type == 'dogs'){
////            Video::getLabelCheckResult();
//        }
//
//        return view('add');

        return $result;
    }


    public function test(){
        $rClient = Video::getRClient();

        $result = $rClient->getContentModeration([
            'JobId' => '18df217c7910f52dd5f59060b49997a89741cf6c592f6f1a634950b758fc5af8'
        ]);

        return $result;
    }


}
