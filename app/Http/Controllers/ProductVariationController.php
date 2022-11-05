<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductVariation\CreateProductVariationRequest;
use App\Http\Requests\ProductVariation\UpdateProductVariationRequest;
use App\Http\Requests\ProductVariation\ReadByProductVariationIdRequest;
use App\Http\Service\ProductVariationService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class ProductVariationController extends Controller
{
    use ResponseUtil;

    public function __construct(protected ProductVariationService $productVariationService){
        //todo code here
    }


    public function create(CreateProductVariationRequest $request): JsonResponse
    {
      return  $this->productVariationService->create($request);
    }



    public function update(UpdateProductVariationRequest $request): JsonResponse
    {
      return  $this->productVariationService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->productVariationService->read();
    }

    public function readById(ReadByProductVariationIdRequest $request): JsonResponse
    {
       return $this->productVariationService->readById($request);
    }
}
