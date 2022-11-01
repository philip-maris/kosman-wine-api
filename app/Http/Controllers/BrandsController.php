<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\ReadByBrandIdRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Service\BrandService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class BrandsController extends Controller
{
    use ResponseUtil;

    public function __construct(protected BrandService $brandService){
        //todo code here
    }


    public function create(CreateBrandRequest $request): JsonResponse
    {
        return  $this->brandService->create($request);
    }


    public function update(UpdateBrandRequest $request): JsonResponse
    {
        return  $this->brandService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->brandService->read();
    }

    public function readById(ReadByBrandIdRequest $request): JsonResponse
    {
        return $this->brandService->readById($request);
    }

    public function delete(ReadByBrandIdRequest $request): JsonResponse
    {
        return $this->brandService->delete($request);
    }
}
