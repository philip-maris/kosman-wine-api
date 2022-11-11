<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderDetails\CreateOrderDetailsRequest;
use App\Http\Requests\OrderDetails\ReadOrderDetailsByIdRequest;
use App\Http\Requests\OrderDetails\ReadOrderDetailsByOrderIdRequest;
use App\Http\Service\OrderDetailsService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class OrderDetailsController extends Controller
{
    use ResponseUtil;

    public function __construct(protected OrderDetailsService $orderDetailsService){
        //todo code here
    }


    public function create(CreateOrderDetailsRequest $request): JsonResponse
    {
      return  $this->orderDetailsService->create($request);
    }

    public function read(): JsonResponse
    {

        return $this->orderDetailsService->read();
    }

    public function readById(ReadOrderDetailsByIdRequest $request): JsonResponse
    {
       return $this->orderDetailsService->readById($request);
    }

    public function readByOrderId(ReadOrderDetailsByOrderIdRequest $request): JsonResponse
    {
       return $this->orderDetailsService->readByOrderId($request);
    }
}
