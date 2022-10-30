<?php

namespace App\Http\Controllers;

use App\Http\Requests\Testimony\CreateNotificationRequest;
use App\Http\Requests\Testimony\CreateTestimonyRequest;
use App\Http\Requests\Testimony\UpdateTestimonyRequest;
use App\Http\Requests\Testimony\ReadByIdRequest;
use App\Http\Service\testimonyService;
use App\Models\Testimony;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class TestimonyController extends Controller
{
    use ResponseUtil;

    public function __construct(protected TestimonyService $testimonyService){
        $this->testimonyService = $testimonyService;
    }


    public function create(CreateTestimonyRequest $request): JsonResponse
    {
      return  $this->testimonyService->create($request);
    }

    public function read(): JsonResponse
    {

        return $this->testimonyService->read();
    }

    public function readById(ReadByIdRequest $request): JsonResponse
    {
       return $this->testimonyService->readById($request);
    }

    public function delete(ReadByIdRequest $request): JsonResponse
    {
       return $this->testimonyService->readById($request);
    }
}
