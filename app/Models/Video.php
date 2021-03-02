<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Aws\Rekognition\RekognitionClient;
use Aws\S3;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    protected $guarded = [];


    public function startModeration()
    {
        $rClient = self::getRClient();

        $jobId = $rClient->startContentModeration([
            'Video' => [
                'S3Object' => [
                    'Bucket' => env('AWS_BUCKET'),
                    'Name' => $this->path,
                ],
            ],
        ]);


        $this->job_id = $jobId['JobId'];
        $this->save();

        return 'success';
    }

    public function getCheckResult($type){
        if ($this->check_result == ''){
            if($type == 'moderation')
            {
                $result = substr(self::getModerationResult($this->job_id), strpos(self::getModerationResult($this->job_id), '{'));

                $this->check_result = json_decode($result, true);
                $this->save();
            }elseif ($type == 'label'){


                $result = self::getLabelCheckResult($this->job_id);

                $result = self::parseLabelResult($result);


                $this->check_result = $result;
                $this->save();
            }
        }

        return $this->check_result;
    }

    public static function getModerationResult($jobId){
        $rClient = self::getRClient();

        $status = '';
        while ($status !== 'SUCCEEDED'){

            $result = $rClient->getContentModeration([
                'JobId' => $jobId
            ]);

            $status = $result->get('JobStatus');

            sleep(2);
        }

        return $result;
    }

    public static function getLabelCheckResult($jobId){
        $rClient = self::getRClient();

        $status = '';
        while ($status !== 'SUCCEEDED'){

            $result = $rClient->getLabelDetection([
                'JobId' => $jobId
            ]);

            $status = $result->get('JobStatus');

            sleep(2);
        }

        $result = $result->get('Labels');

        return $result;
    }

    public function startLabelVideoCheck(){
        $rClient = self::getRClient();

        $jobId = $rClient->startLabelDetection([
            'Video' => [
                'S3Object' => [
                    'Bucket' => env('AWS_BUCKET'),
                    'Name' => $this->path,
                ],
            ],
        ]);

        $this->job_id = $jobId['JobId'];
        $this->save();

        return 'success';
    }

    public static function checkForLabelCheckResult($name){}



    public static function videoCreate($path){

        $video = self::create([
            'name' => basename($path),
            'path' => $path,
            'job_id' => '',
            'check_result' => '',
        ]);

        return $video;

//        if ($type == 'moderation'){
//            $video->startVideoCheck();
//
//            return redirect('add')->with([
////                'message' => $videoCheckResult,
//                'name' => $video->name
//            ]);
//        } elseif ($type == 'label'){
//            $video->startLabelVideoCheck();
//        }

    }

    public static function getRClient(){
        return $rClient = new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest'
        ]);
    }

    public static function parseLabelResult($array){

        $result = [];
        foreach ($array as $label)
        {
            if($label["Label"]["Name"] == "Dog") // and $label["Label"]["Confidence"] >= 90
            {
                $label['Timestamp'] = $label['Timestamp'] / 1000;
                $result[] = $label;
            }
        }

//        dd($result);
        return $result;
    }

    public function startPersonTracking(){
        $rClient = self::getRClient();

        $jobId = $rClient->startPersonTracking([
            'Video' => [
                'S3Object' => [
                    'Bucket' => env('AWS_BUCKET'),
                    'Name' => $this->path,
                ],
            ],
        ]);

        $this->job_id = $jobId['JobId'];
        $this->save();

        return 'success';
    }

    public static function getPersonTrackingResult($jobId){
        $rClient = self::getRClient();

        $status = '';
        while ($status !== 'SUCCEEDED'){
            sleep(30);


            $result = $rClient->getPersonTracking([
                'JobId' => $jobId,
                'SortBy'=>'INDEX'
            ]);

            $status = $result->get('JobStatus');

        }



//        dump(array_key_last($result));
//        dump($result[array_key_last($result)]['Person']['Index']+1);
//        dd($result);

//        return $result;
        $result = $result->get('Persons');

        if ($result){
            return $result[array_key_last($result)]['Person']['Index']+1;
        }
        else{
            return 0;
        }
    }
}
