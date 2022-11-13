<?php

namespace App\Util\BaseUtil;

use Illuminate\Http\JsonResponse;

trait ResponseUtil
{
    protected  function BASE_RESPONSE($data, $responseMessage="Successful", $responseCode=200): JsonResponse
    {

        return response()->json([
            "responseCode"=>$responseCode,
            "responseMessage"=>$responseMessage,
            "data"=>$data
        ])->header('Content-Type', "application/json")
            ->header('Content-Type', "application/json");
    }

     protected  function ERROR_RESPONSE($responseMessage, $responseCode=101): JsonResponse
        {

            return response()->json([
                "responseCode"=>$responseCode,
                "responseMessage"=>$responseMessage
            ])->header('Content-Type', "application/json")
                ->header('Content-Type', "application/json");
        }

        protected  function SUCCESS_RESPONSE($responseMessage): JsonResponse
        {

            return response()->json([
                "responseCode"=>"200",
                "responseMessage"=>$responseMessage
            ])->header('Content-Type', "application/json")
                ->header('Content-Type', "application/json");
        }

}
