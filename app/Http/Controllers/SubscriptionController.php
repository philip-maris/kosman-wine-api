<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Http\Requests\Subscription\UpdateSubscriptionRequest;
use App\Http\Requests\Subscription\ReadByIdRequest;
use App\Http\Service\subscriptionService;
use App\Models\Subscription;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    use ResponseUtil;

    public function __construct(protected SubscriptionService $subscriptionService){
        $this->subscriptionService = $subscriptionService;
    }


    public function create(CreateSubscriptionRequest $request): JsonResponse
    {
      return  $this->subscriptionService->create($request);
    }



    public function read(): JsonResponse
    {

        return $this->subscriptionService->read();
    }

    public function readById(ReadByIdRequest $request): JsonResponse
    {
       return $this->subscriptionService->readById($request);
    }
}
