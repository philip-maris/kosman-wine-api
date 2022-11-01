<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\CreateReviewRequest;
use App\Http\Requests\Review\ReadSubscriptionByCustomerIdRequest;
use App\Http\Requests\Review\ReadByReviewIdRequest;
use App\Http\Service\ReviewService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    use ResponseUtil;

    public function __construct(protected ReviewService $reviewService){
        //todo code
    }


    public function create(CreateReviewRequest $request): JsonResponse
    {
      return  $this->reviewService->create($request);
    }

    public function read(): JsonResponse
    {
        return $this->reviewService->read();
    }

    public function readById(ReadByReviewIdRequest $request): JsonResponse
    {
       return $this->reviewService->readById($request);
    }

    public function readByProductId(ReadSubscriptionByCustomerIdRequest $request): JsonResponse
    {
       return $this->reviewService->readByProductId($request);
    }
}
