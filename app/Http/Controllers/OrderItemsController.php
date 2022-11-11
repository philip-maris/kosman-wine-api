<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItems\CreateOrderItemsRequest;
use App\Http\Requests\OrderItems\ReadOrderItemsByIdRequest;
use App\Http\Requests\OrderItems\ReadOrderItemsByOrderIdRequest;
use App\Http\Service\OrderItemsService;
use App\Util\baseUtil\ResponseUtil;
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
