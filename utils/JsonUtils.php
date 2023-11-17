<?php


class JsonUtils {

    public static function prepareResponseDataAsJson($status, $message, $redirectUrl) {

        $response = array(
            'status'   => $status,
            'message'  => $message,
            'redirect' => $redirectUrl
        );

        // Convert the response array to JSON format
        return json_encode($response);
    }

}


?>