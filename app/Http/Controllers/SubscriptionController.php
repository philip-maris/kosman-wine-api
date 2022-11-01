<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Http\Requests\Subscription\ReadBySubscriptionIdRequest;
use App\Http\Service\SubscriptionService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    use ResponseUtil;

    public function __construct(protected SubscriptionService $subscriptionService){
        //todo code here
    }


    public function create(CreateSubscriptionRequest $request): JsonResponse
    {
      return  $this->subscriptionService->create($request);
    }



    public function read(): JsonResponse
    {

        return $this->subscriptionService->read();
    }

    public function readById(ReadBySubscriptionIdRequest $request): JsonResponse
    {
       return $this->subscriptionService->readById($request);
    }
}
