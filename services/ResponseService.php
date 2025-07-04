<?php

class ResponseService {

    public static function success_response($payload){
        $response = [];
        $response["status"] = 200;
        $response["payload"] = $payload;
        return json_encode($response);
    }
    public static function error_response($message){
        $response = [];
        $response["status"] = 400;
        $response["message"] = $message;
        return json_encode($message);
    }
}