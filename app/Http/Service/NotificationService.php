<?php

namespace App\Http\Service;

use App\Http\Requests\Authentication\InitiateEnrollmentRequest;
use App\Http\Requests\Notification\ReadByIdRequest;
use App\Http\Requests\Notification\ReadByCustomerTypeRequest;
use App\Http\Requests\Testimony\CreateNotificationRequest;
use App\Mail\OtpMail;
use App\Models\Customer;
use App\Models\Notification;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use function MongoDB\BSON\toJSON;


class NotificationService
{
    use ResponseUtil;

    public function create(CreateNotificationRequest $request): JsonResponse
    {
        try {

            //todo validate
            $request->validated($request);
            $testNotification = Notification::where('notificationState', $request['notificationState'])->first();
            // validate ids
            if($request['notificationCustomerType'] == "ADMIN"){
                // check admin id
            }else {
                $customer = Customer::find($request['notificationCustomerId']);
                if (!$customer) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            }

            $notification = Notification::create(array_merge($request->all(),['notificationStatus'=>'ACTIVE']));
            if (!$notification) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function read(): JsonResponse
    {
        try {
            $notification = Notification::all();
            if (!$notification)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($notification);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readById(ReadByIdRequest $request): JsonResponse
    {
        try {
            //  validation
            $request->validated($request->all());

            $notification = Notification::where('notificationId', $request['notificationId'])->first();
            if (!$notification) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($notification);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readByCustomerType(ReadByCustomerTypeRequest $request): JsonResponse
    {
        try {
            //  validation
            $request->validated($request->all());

            $notification = Notification::where('notificationCustomerType', $request['notificationCustomerType'])->get();
            if (!$notification) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($notification);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }
}
