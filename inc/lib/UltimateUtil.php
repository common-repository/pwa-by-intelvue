<?php

class UltimateUtils {
    
    public static function response_json( $data, $message, $status ) {
        $response['data'] = $data;
        $response['message'] = $message;
        $response['status'] = $status;
        ob_get_clean();
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
}