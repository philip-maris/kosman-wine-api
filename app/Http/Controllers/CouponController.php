<?php

namespace App\Http\Controllers;

use App\Http\Requests\Coupon\CreateCouponRequest;
use App\Http\Requests\Coupon\DeleteCouponRequest;
use App\Http\Requests\Coupon\ReadByCouponCodeRequest;
use App\Http\Requests\Coupon\ReadByCouponIdRequest;
use App\Http\Requests\Coupon\UpdateCouponRequest;
use App\Http\Service\CouponService;
use App\Util\baseUtil\ResponseUtil;
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
