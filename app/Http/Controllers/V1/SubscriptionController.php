<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Subscription\CreateSubscriptionRequest;
use App\Http\Requests\V1\Api\Subscription\ReadBySubscriptionIdRequest;
use App\Http\Service\Vi\Api\SubscriptionService;
use App\Util\BaseUtil\ResponseUtil;
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
