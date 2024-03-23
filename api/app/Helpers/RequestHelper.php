<?php 

require_once 'ResponseObject.php';


class RequestHelper {
    public static function respond($status, $message, $payload) {
        $request = new ResponseObject($status, $message, $payload);
        
        $response = json_encode($request);
        
        echo $response;
    }
}