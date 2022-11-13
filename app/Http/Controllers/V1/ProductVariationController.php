<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\ProductVariation\CreateProductVariationRequest;
use App\Http\Requests\V1\Api\ProductVariation\ReadByProductVariationIdRequest;
use App\Http\Requests\V1\Api\ProductVariation\UpdateProductVariationRequest;
use App\Http\Service\Vi\Api\ProductVariationService;
use App\Util\BaseUtil\ResponseUtil;
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
