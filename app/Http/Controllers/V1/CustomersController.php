<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Customer\ReadByCustomerIdRequest;
use App\Http\Requests\V1\Api\Customer\UpdateCustomerRequest;
use App\Http\Service\Vi\Api\CustomerService;
use App\Util\BaseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class CustomersController extends Controller
{
    use ResponseUtil;

    public function __construct(protected CustomerService $customerService){

        //todo code here
    }


    public function update(UpdateCustomerRequest $request): JsonResponse
    {
      return  $this->customerService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->customerService->read();
    }

    public function revalidate(): JsonResponse
    {
        return $this->customerService->revalidate();
    }



    public function readById(ReadByCustomerIdRequest $request): JsonResponse
    {
       return $this->customerService->readById($request);
    }
}
