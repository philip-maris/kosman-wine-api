<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\WishList\CreateWishlistRequest;
use App\Http\Requests\V1\Api\WishList\ReadByWishlistIdRequest;
use App\Http\Requests\V1\Api\WishList\UpdateWishlistRequest;
use App\Http\Service\Vi\Api\WishlistService;
use App\Util\BaseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class WishlistsController extends Controller
{
    use ResponseUtil;

    public function __construct(protected WishlistService $wishListService){
        //todo code here
    }


    public function create(CreateWishlistRequest $request): JsonResponse
    {
        return  $this->wishListService->create($request);
    }


    public function update(UpdateWishlistRequest $request): JsonResponse
    {
        return  $this->wishListService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->wishListService->read();
    }

    public function readById(ReadByWishlistIdRequest $request): JsonResponse
    {
        return $this->wishListService->readById($request);
    }

    public function delete(ReadByWishlistIdRequest $request): JsonResponse
    {
        return $this->wishListService->delete($request);
    }
}
