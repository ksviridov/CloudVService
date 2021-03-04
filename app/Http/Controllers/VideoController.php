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

        return response($this->label(),200)->with([
            'items' => $result,
            'message' =>'File uploaded'
            ]);
//        return view('label')->with('items', $result);
    }


    public function test(){
//        $rClient = Video::getRClient();
//
//        $result = $rClient->getLabelDetection([
//            'JobId' => '3caeebecf4cd98003b1b816679c0b5a838013b14466b9d6177e14ceacd072598'
//        ]);
//
//        $items = Video::parseLabelResult($result->get('Labels'));
//
////        $items = Video::all();
////        dd($items);
//        return view('result', compact('items'));


//        $video = Video::where('id','=',9)->get();

//        $video->check_result->sort
    }

    public function personTrackingResult(Request $request){
        $tf = $request->file('video')->store('videos', 's3');

        $video = Video::videoCreate($tf);

        $video->startPersonTracking();

        $video->check_result = 0;
        $video->save();

//        if ($video->id % 10 == 0){
//
//        }
//        $result = $video->getPersonTrackingResult($video->job_id);

        if ($video->id > 9){
            $tenBehind = Video::find($video->id - 9);

            $tenBehind->check_result = $tenBehind->getPersonTrackingResult($tenBehind->job_id);
            $tenBehind->save();
        }



    }

    public function index(){
        return view('index');
    }

    public function person(){
        $videos = Video::all();

        return view('autoload')->with([
            'videos' => $videos,
        ]);
    }

    public function saveToS3(Request $request){
        $tf = $request->file('video')->store('videos', 's3');

        $video = Video::videoCreate($tf);

//        $video->startPersonTracking();

    }
}
