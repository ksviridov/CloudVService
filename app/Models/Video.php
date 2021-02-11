<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Aws\Rekognition\RekognitionClient;
use Aws\S3;

class Video extends Model
{
    protected $guarded = [];


    public function startVideoCheck()
    {
        $rClient = self::getRClient();

        $jobId = $rClient->startContentModeration([
            'Video' => [
                'S3Object' => [
                    'Bucket' => 'cloudvservice',
                    'Name' => $this->path,
                ],
            ],
        ]);


        $this->job_id = $jobId['JobId'];
        $this->save();

        return 'success';
    }

    public static function getResult($jobId){
        $rClient = self::getRClient();

        $result = $rClient->getContentModeration([
            'JobId' => $jobId
        ]);

        return $result;
    }

    public static function getRClient(){
        return $rClient = new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest'
        ]);
    }

}
