<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\OrderDetails\CreateOrderDetailsRequest;
use App\Http\Requests\V1\Api\OrderDetails\ReadOrderDetailsByIdRequest;
use App\Http\Requests\V1\Api\OrderDetails\ReadOrderDetailsByOrderIdRequest;
use App\Http\Service\Vi\Api\OrderDetailsService;
use App\Util\BaseUtil\ResponseUtil;
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
