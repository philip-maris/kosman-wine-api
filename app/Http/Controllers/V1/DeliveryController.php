<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Delivery\CreateDeliveryRequest;
use App\Http\Requests\V1\Api\Delivery\ReadByDeliveryIdRequest;
use App\Http\Requests\V1\Api\Delivery\UpdateDeliveryRequest;
use App\Http\Service\Vi\Api\DeliveryService;
use App\Util\BaseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class DeliveryController extends Controller
{
    use ResponseUtil;

    public function __construct(protected DeliveryService $deliveryService){
        //todo code here
    }


    public function create(CreateDeliveryRequest $request): JsonResponse
    {
      return  $this->deliveryService->create($request);
    }



    public function update(UpdateDeliveryRequest $request): JsonResponse
    {
      return  $this->deliveryService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->deliveryService->read();
    }

    public function readById(ReadByDeliveryIdRequest $request): JsonResponse
    {
       return $this->deliveryService->readById($request);
    }
}
