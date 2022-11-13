<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Cart\CreateCartRequest;
use App\Http\Requests\V1\Api\Cart\ReadByCartIdRequest;
use App\Http\Requests\V1\Api\Cart\ReadByCustomerIdRequest;
use App\Http\Requests\V1\Api\Cart\UpdateCartRequest;
use App\Http\Service\Vi\Api\CartService;
use App\Util\BaseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    use ResponseUtil;

    public function __construct(protected CartService $cartService){
        //todo code here
    }

    public function create(CreateCartRequest $request): JsonResponse
    {
      return  $this->cartService->create($request);
    }

    public function update(UpdateCartRequest $request): JsonResponse
    {
      return  $this->cartService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->cartService->read();
    }

    public function readByCustomerId(ReadByCustomerIdRequest $request): JsonResponse
    {
       return $this->cartService->readByCustomerId($request);
    }

    public function delete(ReadByCartIdRequest $request): JsonResponse
    {
       return $this->cartService->delete($request);
    }
}
