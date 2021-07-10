<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($data,$message, $status=200)
    {
    	$response = [
            'data'    => $data,
            'message' => $message,
        ];

        return response()->json($response, $status);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $status)
    {
    	$response = [
            'message' => $error,
        ];

        return response()->json($response, $status=$status);
    }


}
