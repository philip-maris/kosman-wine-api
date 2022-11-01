<?php

namespace App\Http\Controllers;

use App\Http\Requests\Testimony\CreateTestimonyRequest;
use App\Http\Requests\Testimony\ReadByTestimonyIdRequest;
use App\Http\Service\TestimonyService;
use App\Util\baseUtil\ResponseUtil;
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
