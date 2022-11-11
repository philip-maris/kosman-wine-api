<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\FilterProductBySellingPrice;
use App\Http\Requests\Product\ReadByProductIdRequest;
use App\Http\Requests\Product\ReadByProductVariationIdRequest;
use App\Http\Requests\Product\ReadProductByBrandId;
use App\Http\Requests\Product\ReadProductByCategoryId;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Service\ProductService;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    public function __construct(protected ProductService $productService){

        //todo code here

    }

    public function create(CreateProductRequest $request): JsonResponse
    {
        return $this->productService->create($request);
    }
    public function update(UpdateProductRequest $request): JsonResponse
    {
        return $this->productService->update($request);
    }
    public function read(): JsonResponse
    {
        return $this->productService->read();
    }
    public function readById(ReadByProductIdRequest $request): JsonResponse
    {
        return $this->productService->readById($request);
    }
    public function readProductByBrandId(ReadProductByBrandId $request): JsonResponse
    {
        return $this->productService->readProductByBrandId($request);
    }
    public function readProductByCategoryId(ReadProductByCategoryId $request): JsonResponse
    {
        return $this->productService->readProductByCategoryId($request);
    }
    public function filterProductBySellingPrice(FilterProductBySellingPrice $request): JsonResponse
    {
        return $this->productService->filterProductBySellingPrice($request);
    }
    public function readProductOfferPrice(): JsonResponse
    {
        return $this->productService->readProductOfferPrice();
    }
    public function readByProductVariation(ReadByProductVariationIdRequest $request): JsonResponse
    {
        return $this->productService->readByProductVariationId($request);
    }
    public function delete(ReadByProductIdRequest $request): JsonResponse
    {
        return $this->productService->delete($request);
    }
}
