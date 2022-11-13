<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Coupon\CreateCouponRequest;
use App\Http\Requests\V1\Api\Coupon\DeleteCouponRequest;
use App\Http\Requests\V1\Api\Coupon\ReadByCouponCodeRequest;
use App\Http\Requests\V1\Api\Coupon\ReadByCouponIdRequest;
use App\Http\Requests\V1\Api\Coupon\UpdateCouponRequest;
use App\Http\Service\Vi\Api\CouponService;
use App\Util\BaseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class CouponController extends Controller
{
    use ResponseUtil;

    public function __construct(protected CouponService $couponService){
        //todo code here
    }


    public function create(CreateCouponRequest $request): JsonResponse
    {
      return  $this->couponService->create($request);
    }



    public function update(UpdateCouponRequest $request): JsonResponse
    {
      return  $this->couponService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->couponService->read();
    }

    public function readById(ReadByCouponIdRequest $request): JsonResponse
    {
       return $this->couponService->readById($request);
    }

    public function readByCouponCode(ReadByCouponCodeRequest $request): JsonResponse
    {
       return $this->couponService->readByCouponCode($request);
    }

    public function delete(DeleteCouponRequest $request): JsonResponse
    {
       return $this->couponService->delete($request);
    }
}
