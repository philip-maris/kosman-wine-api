<?php

namespace App\Http\Service;

use App\Http\Requests\Authentication\InitiateEnrollmentRequest;
use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Http\Requests\Subscription\ReadByIdRequest;
use App\Http\Requests\Subscription\UpdateSubscriptionRequest;
use App\Mail\OtpMail;
use App\Models\Customer;
use App\Models\Subscription;
use App\Models\Notification;
use App\Util\baseUtil\IdVerificationUtil;
use App\Util\baseUtil\ResponseUtil;
use App\Util\baseUtil\NotificationUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use function MongoDB\BSON\toJSON;


class SubscriptionService
{
    use ResponseUtil;
    use NotificationUtil;
    use IdVerificationUtil;


    public function create(CreateSubscriptionRequest $request): JsonResponse
    {
        try {

            //todo validate
            $request->validated($request);
            $customer = Customer::where('customerId', $request['subscriptionCustomerId'])->first();
            if (!$customer) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD,"INVALID CUSTOMER ID");

            $testSubscription = Subscription::where('subscriptionCustomerId', $request['subscriptionCustomerId'])->first();
            if ($testSubscription) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE,"CUSTOMER HAS ALREADY SUBSCRIBED");

            $subscription = Subscription::create(array_merge($request->all(),
                ['subscriptionStatus' => 'ACTIVE']));
            //todo check its successful
            if (!$subscription) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }


    public function read(): JsonResponse
    {
        try {
            $subscription = Subscription::all();
            if (!$subscription) throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($subscription);
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readById(ReadByIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $subscription = Subscription::where('subscriptionId', $request['subscriptionId'])->first();
            if (!$subscription) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return $this->BASE_RESPONSE($subscription);
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

}