<?php

namespace App\Http\Service\Vi\Api;

use App\Http\Requests\V1\Api\Subscription\CreateSubscriptionRequest;
use App\Http\Requests\V1\Api\Subscription\ReadBySubscriptionIdRequest;
use App\Models\V1\Customer;
use App\Models\V1\Subscription;
use App\Util\BaseUtil\IdVerificationUtil;
use App\Util\BaseUtil\NotificationUtil;
use App\Util\BaseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;


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

    public function readById(ReadBySubscriptionIdRequest $request): JsonResponse
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
