<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Banner\CreateBannerRequest;
use App\Http\Requests\V1\Api\Banner\ReadByBannerIdRequest;
use App\Http\Requests\V1\Api\Banner\UpdateBannerRequest;
use App\Http\Service\Vi\Api\BannerService;
use App\Util\BaseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class BannerController extends Controller
{
    use ResponseUtil;

    public function __construct(protected BannerService $bannerService){
        //todo code here
    }


    public function create(CreateBannerRequest $request): JsonResponse
    {
      return  $this->bannerService->create($request);
    }



    public function update(UpdateBannerRequest $request): JsonResponse
    {
      return  $this->bannerService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->bannerService->read();
    }

    public function readById(ReadByBannerIdRequest $request): JsonResponse
    {
       return $this->bannerService->readById($request);
    }
}
