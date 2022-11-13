<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Order\CreateOrderRequest;
use App\Http\Requests\V1\Api\Order\ReadByOrderIdRequest;
use App\Http\Requests\V1\Api\Order\UpdateOrderRequest;
use App\Http\Service\Vi\Api\OrderService;
use App\Util\BaseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    use ResponseUtil;

    public function __construct(protected OrderService $orderService){
        //todo code here
    }


    public function create(CreateOrderRequest $request): JsonResponse
    {
      return  $this->orderService->create($request);
    }



    public function update(UpdateOrderRequest $request): JsonResponse
    {
      return  $this->orderService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->orderService->read();
    }

    public function readById(ReadByOrderIdRequest $request): JsonResponse
    {
       return $this->orderService->readById($request);
    }
}
