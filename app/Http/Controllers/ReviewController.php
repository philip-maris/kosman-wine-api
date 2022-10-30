<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\CreateSubscriptionRequest;
use App\Http\Requests\Review\ReadSubscriptionByCustomerIdRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Http\Requests\Review\ReadByIdRequest;
use App\Http\Service\reviewService;
use App\Models\Review;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    use ResponseUtil;

    public function __construct(protected ReviewService $reviewService){
        $this->reviewService = $reviewService;
    }


    public function create(CreateSubscriptionRequest $request): JsonResponse
    {
      return  $this->reviewService->create($request);
    }

    public function read(): JsonResponse
    {
        return $this->reviewService->read();
    }

    public function readById(ReadByIdRequest $request): JsonResponse
    {
       return $this->reviewService->readById($request);
    }

    public function readByProductId(ReadSubscriptionByCustomerIdRequest $request): JsonResponse
    {
       return $this->reviewService->readByProductId($request);
    }
}
