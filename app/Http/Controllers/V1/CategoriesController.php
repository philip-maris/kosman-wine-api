<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Category\CreateCategoryRequest;
use App\Http\Requests\V1\Api\Category\ReadByIdCategoryRequest;
use App\Http\Requests\V1\Api\Category\UpdateCategoryRequest;
use App\Http\Service\Vi\Api\CategoryService;
use App\Util\BaseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class CategoriesController extends Controller
{
    use ResponseUtil;
    public function __construct(protected CategoryService $categoryService){
        //todo code here
    }
    public function create(CreateCategoryRequest $request): JsonResponse
    {
        return $this->categoryService->create($request);
    }
    public function update(UpdateCategoryRequest $request): JsonResponse
    {
        return $this->categoryService->update($request);
    }
    public function read(): JsonResponse
    {
        return $this->categoryService->read();
    }
    public function readById(ReadByIdCategoryRequest $request): JsonResponse
    {

            return $this->categoryService->readById($request);
    }
    public function delete(ReadByIdCategoryRequest $request): JsonResponse
    {
        return $this->categoryService->delete($request);
    }
}
