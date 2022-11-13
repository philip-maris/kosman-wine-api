<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\OrderItems\CreateOrderItemsRequest;
use App\Http\Requests\V1\Api\OrderItems\ReadOrderItemsByIdRequest;
use App\Http\Requests\V1\Api\OrderItems\ReadOrderItemsByOrderIdRequest;
use App\Http\Service\Vi\Api\OrderItemsService;
use App\Util\BaseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class OrderItemsController extends Controller
{
    use ResponseUtil;

    public function __construct(protected OrderItemsService $orderItemsService){
        //todo code here
    }


    public function create(CreateOrderItemsRequest $request): JsonResponse
    {
      return  $this->orderItemsService->create($request);
    }

    public function read(): JsonResponse
    {

        return $this->orderItemsService->read();
    }

    public function readById(ReadOrderItemsByIdRequest $request): JsonResponse
    {
       return $this->orderItemsService->readById($request);
    }

    public function readByOrderId(ReadOrderItemsByOrderIdRequest $request): JsonResponse
    {
       return $this->orderItemsService->readByOrderId($request);
    }
}
