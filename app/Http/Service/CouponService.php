<?php

namespace App\Http\Service;

use App\Http\Requests\Coupon\CreateCouponRequest;
use App\Http\Requests\Coupon\DeleteCouponRequest;
use App\Http\Requests\Coupon\ReadByCouponCodeRequest;
use App\Http\Requests\Coupon\ReadByCouponIdRequest;
use App\Http\Requests\Coupon\UpdateCouponRequest;
use App\Models\Customer;
use App\Models\Coupon;
use App\Util\baseUtil\IdVerificationUtil;
use App\Util\baseUtil\NotificationUtil;
use App\Util\baseUtil\RandomUtil;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use \Illuminate\Http\JsonResponse;


class CouponService
{
    use ResponseUtil;
    use RandomUtil;
    use IdVerificationUtil;
    use NotificationUtil;

    public function create(CreateCouponRequest $request): JsonResponse
    {
        try {
            //  validate
            $request->validated($request);
            // verify admin
            $customer = $this->VERIFY_ADMIN($request['couponCustomerId']);

            $coupon = Coupon::create([
                'couponCode'=>$this->couponCodeGenerator(),
                'couponStatus'=>'ACTIVE',
                'couponValue'=>$request['couponValue'],
            ]);

            //todo check its successful
            if (!$coupon) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            // SEND NOTIFICATION
            $this->SEND_CREATION_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'],"#{$request['couponValue']}",'Coupon'
            );
            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function update(UpdateCouponRequest $request): JsonResponse
    {
        try {
            //  validate
            $request->validated($request);

            // verify admin
            $customer = $this->VERIFY_ADMIN($request['couponCustomerId']);

             $coupon = Coupon::where('couponId', $request['couponId'])->first();
             if (!$coupon) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            $response =    $coupon->update(array_merge($request->except('couponId'),
                ['couponStatus'=>'ACTIVE']));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);
            // SEND NOTIFICATION
            $this->SEND_UPDATE_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'],"#{$coupon['couponValue']}","#{$request['couponValue']}"
            );

            return $this->SUCCESS_RESPONSE("UPDATE SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }


    public function read(): JsonResponse
    {
        try {
            $coupon = Coupon::all();
            if (!$coupon)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($coupon);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function readById(ReadByCouponIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $coupon = Coupon::where('couponId', $request['couponId'])->first();
            if (!$coupon) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($coupon);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }


    public function readByCouponCode(ReadByCouponCodeRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $coupon = Coupon::where('couponCode', $request['couponCode'])->first();
            if (!$coupon) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($coupon);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }


    public function delete(DeleteCouponRequest $request){
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            // verify admin
            $customer = $this->VERIFY_ADMIN($request['couponCustomerId']);

            $coupon = Coupon::where('couponId', $request['couponId'])->first();
            if (!$coupon) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            if (!$coupon->delete()) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            // SEND NOTIFICATION
            $this->SEND_DELETE_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'], "#{$coupon['couponValue']}", 'Coupon'
            );
            return  $this->SUCCESS_RESPONSE("COUPON DELETED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }


    public function redeemCoupon( $couponCode , $customerId): JsonResponse
    {
        try {
            $coupon = Coupon::where('couponCode', $couponCode)->first();
            if (!$coupon) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            if ($coupon['couponStatus'] == 'ACTIVE'){
                // deactivate the coupon
                $updateResponse =    $coupon->update([
                    'couponStatus'=>'REDEEMED'
                ]);
                $customer = Customer::find($customerId);
                if (!$updateResponse) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);

                // SEND NOTIFICATION
                $this->SEND_NOTIFICATION(
                    "{$customer['customerFirstName']} " ."{$customer['customerLastName']} redeemed a #{$coupon['couponValue']} coupon",
                    'PURPLE',$customer->id,'COUPON REDEEMED'
                );
            }else
            return  $this->BASE_RESPONSE($coupon);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    function couponCodeGenerator()
    {
        $couponGenerated = $this->RANDOM_STRING();
        // Check if coupon code generated is unique
       $coupon =  Coupon::where('couponCode',$couponGenerated )->first();

        if(!$coupon){
            return $couponGenerated;
        }
        else {//if not unique re-call the function and generate again
             $this->couponCodeGenerator();
        };
//        return $couponGenerated;
    }

}
