<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\ReadSubscriptionByCustomerIdRequest;
use App\Http\Requests\V1\Api\Review\CreateReviewRequest;
use App\Http\Requests\V1\Api\Review\ReadByReviewIdRequest;
use App\Http\Service\Vi\Api\ReviewService;
use App\Util\BaseUtil\ResponseUtil;
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
