<?php

namespace App\Http\Controllers;

use App\Http\Requests\Banner\CreateBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Http\Requests\Banner\ReadByBannerIdRequest;
use App\Http\Service\BannerService;
use App\Util\baseUtil\ResponseUtil;
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
