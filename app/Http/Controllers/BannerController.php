<?php

namespace App\Http\Controllers;

use App\Http\Requests\Banner\CreateBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Http\Requests\Banner\ReadByIdRequest;
use App\Http\Service\bannerService;
use App\Models\Banner;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class BannerController extends Controller
{
    use ResponseUtil;

    public function __construct(protected BannerService $bannerService){
        $this->bannerService = $bannerService;
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

    public function readById(ReadByIdRequest $request): JsonResponse
    {
       return $this->bannerService->readById($request);
    }
}
