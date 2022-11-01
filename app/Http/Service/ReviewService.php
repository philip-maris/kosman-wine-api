<?php

namespace App\Http\Service;

use App\Http\Requests\Review\CreateReviewRequest;
use App\Http\Requests\Review\ReadByReviewIdRequest;
use App\Http\Requests\Review\ReadSubscriptionByCustomerIdRequest;
use App\Models\Product;
use App\Models\Review;
use App\Util\baseUtil\NotificationUtil;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use \Illuminate\Http\JsonResponse;


class ReviewService
{
    use ResponseUtil;
    use NotificationUtil;

    public function create(CreateReviewRequest $request): JsonResponse
    {
        try {

            //todo validate
            $request->validated($request);
            $product = Product::find($request['reviewProductId']);
            if (!$product) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "INVALID PRODUCT ID");

            $review = Review::create(array_merge($request->all(),['reviewStatus'=>'ACTIVE']));
            if (!$review) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function read(): JsonResponse
    {
        try {
            $review = Review::all();
            if (!$review)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($review);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readById(ReadByReviewIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $review = Review::where('reviewId', $request['reviewId'])->first();
            if (!$review) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($review);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readByProductId(ReadSubscriptionByCustomerIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $review = Review::where('reviewProductId', $request['reviewProductId'])->first();
            if (!$review) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($review);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }
}
