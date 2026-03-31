<?php

use App\Models\AdminActivityLog;
use App\Models\Notification;
use App\Models\User;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

if (!function_exists('pushFileToStorage')) {
    /**
     * this function helps to upload files into aws s3 bucket
     * @param  string $image
     * @param  string $foldername: the desired folder for which the image is to be stored in the storage
     * @return string the image path or url
     */
    function pushFileToStorage($image, $folder_name)
    {
        $name = Str::random(20);
        $filePath = $folder_name . '/' . $name;
        $imagePath = 'https://' . config('services.aws.bucket') . '.s3.' . config('services.aws.region') . '.amazonaws.com/' . $filePath;
        Storage::disk('s3')->put($filePath, file_get_contents($image));
        return $imagePath;
        // Storage::disk('public')->put($filePath, file_get_contents($image));
        // return $filePath;
    }
}

if (!function_exists('pushFileStringToStorage')) {
    /**
     * this function helps to upload files into aws s3 bucket
     * @param  string $image
     * @param  string $foldername: the desired folder for which the image is to be stored in the storage
     * @return string the image path or url
     */
    function pushFileStringToStorage($file_string, $folder_name)
    {
        $name = Str::random(20);
        $filePath = $folder_name . '/' . $name;
        $file_contents = base64_decode($file_string, true);
        $imagePath = 'https://' . config('services.aws.bucket') . '.s3.' . config('services.aws.region') . '.amazonaws.com/' . $filePath;
        Storage::disk('s3')->put($filePath, $file_contents);
        return $imagePath;
        // Storage::disk('public')->put($filePath, $file_string);
        // return $filePath;
    }
}


if(!function_exists("pushFileStringToStorageCloudinary")){
    function  pushFileStringToStorageCloudinary($file_string, $folder_name){
        $name = Str::random(20);
        $filePath = $folder_name . '/' . $name;
        $file_contents = base64_decode($file_string, true);
        $imagePath =
        $imagePath = 'https://' . config('services.aws.bucket') . '.s3.' . config('services.aws.region') . '.amazonaws.com/' . $filePath;
        Storage::disk('s3')->put($filePath, $file_contents);
        return $imagePath;
    }
}

if (!function_exists('uniqueRandomChar')) {
    /**
     * @param  string table
     * @param  string column
     * @param  int length of string
     * @return string a unique set of random characters
     */
    function uniqueRandomChar($table, $column, $length)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shuffle the $str_result and returns substring of specified length
        $string = substr(str_shuffle($str_result), 0, $length);

        //check if string already exists in the table
        DB::table($table)->where($column, $string)->first() ? uniqueRandomChar($table, $column, $length) :  $string;

        return $string;
    }
}

if (!function_exists('saveAdminActivityLog')) {
    /**
     * Save admin activity logs
     * @param  string $action
     * @param  string $model
     * @param  string $modelId
     * @return \App\Models\AdminActivityLog
     */
    function saveAdminActivityLog($action, $model, $modelId)
    {
        $userId = auth()->user()->id;

        AdminActivityLog::create([
            'admin_user_id' => $userId,
            'model' => $model,
            'model_id' => $modelId,
            'action' => $action
        ]);
    }
}

if (!function_exists('newNotification')) {
    /**
     * Save admin activity logs
     * @param  string $message
     * @param  string $model_id
     * @param  string $trigger
     * @param  string $status
     * @return \App\Models\Notification
     */
    function newNotification($sender_user_id, $receiver_user_id, $model_id, $model, $title, $message, $sendPush = false, $action = null)
    {
        $user = User::find($receiver_user_id);
        $notification = Notification::create([
            'sender_user_id' => $sender_user_id,
            'receiver_user_id' => $receiver_user_id,
            'model' => $model,
            'model_id' => $model_id,
            'title' => $title,
            'message' => $message,
            'action' => $action
        ]);
        if ($sendPush == true && $user->is_notify == true) {
            $data = [
                'body' => $message,
                'title' => $title,
                'subtitle' => null,
                'optional' => $notification
            ];
            firebase_push_notification($receiver_user_id, $data);
        }
    }
}

if (!function_exists('uploadFileToSpaces')) {
    function uploadFileToSpaces($file, $folder_name)
    {
        $s3Config = [
            'version' => 'latest',
            'region'  => env('DIGITALOCEAN_SPACES_REGION'),
            'endpoint' => env('DIGITALOCEAN_SPACES_ENDPOINT'),
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => env('DIGITALOCEAN_SPACES_KEY'),
                'secret' => env('DIGITALOCEAN_SPACES_SECRET'),
            ],
        ];
        $client = new S3Client($s3Config);
        $fileKey = 'testing/' . $folder_name . '/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
        $client->putObject([
            'Bucket' => env('DIGITALOCEAN_SPACES_BUCKET'),
            'Key'    => $fileKey,
            'Body'   => file_get_contents($file),
            'ACL'    => 'public-read',
        ]);
        $filePath = 'https://' . env('DIGITALOCEAN_SPACES_BUCKET') . '.' . env('DIGITALOCEAN_SPACES_REGION') . '.digitaloceanspaces.com/' . env('DIGITALOCEAN_SPACES_BUCKET') . '/' . $fileKey;
        return $filePath;
    }
}

if (!function_exists('uploadStringFileToSpaces')) {
    function uploadStringFileToSpaces($file_string, $folder_name)
    {
        $client = new S3Client([
            'version' => 'latest',
            'region'  => env('DIGITALOCEAN_SPACES_REGION'),
            'endpoint' =>  env('DIGITALOCEAN_SPACES_ENDPOINT'),
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => env('DIGITALOCEAN_SPACES_KEY'),
                'secret' => env('DIGITALOCEAN_SPACES_SECRET'),
            ],
        ]);

        $type = explode(';', $file_string)[0];
        $explodeType = explode('/', $type);
        $file_type = $explodeType[0];
        $extension = explode('/', $type)[1];

        $file = str_replace($file_type . '/' . $extension . ';base64,', '', $file_string);
        $file = str_replace(' ', '+', $file);
        $fileKey = 'testing/' . $folder_name . '/' . Str::random(20) . '.' . $extension;
        $data = base64_decode($file);

        //upload the image to the server base64
        $result = $client->putObject([
            'Bucket' => env('DIGITALOCEAN_SPACES_BUCKET'),
            'Key'    => $fileKey,
            'Body'   => $data,
            'ACL'    => 'public-read',
            'ContentType' => $extension,
            'ContentEncoding' => 'base64'
        ]);
        // Generate the URL for the uploaded file
        $fileUrl = 'https://' . env('DIGITALOCEAN_SPACES_BUCKET') . '.' . env('DIGITALOCEAN_SPACES_REGION') . '.digitaloceanspaces.com/' . env('DIGITALOCEAN_SPACES_BUCKET') . '/' . $fileKey;
        return $fileUrl;
    }
}
