<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Testimony\CreateTestimonyRequest;
use App\Http\Requests\V1\Api\Testimony\ReadByTestimonyIdRequest;
use App\Http\Service\Vi\Api\TestimonyService;
use App\Util\BaseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class TestimonyController extends Controller
{
    use ResponseUtil;

    public function __construct(protected TestimonyService $testimonyService){
        //todo code here
    }


    public function create(CreateTestimonyRequest $request): JsonResponse
    {
      return  $this->testimonyService->create($request);
    }

    public function read(): JsonResponse
    {

        return $this->testimonyService->read();
    }

    public function readById(ReadByTestimonyIdRequest $request): JsonResponse
    {
       return $this->testimonyService->readById($request);
    }

    public function delete(ReadByTestimonyIdRequest $request): JsonResponse
    {
       return $this->testimonyService->readById($request);
    }
}
