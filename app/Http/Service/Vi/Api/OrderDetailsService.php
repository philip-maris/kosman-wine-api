<?php

namespace App\Http\Service\Vi\Api;

use App\Http\Requests\V1\Api\OrderDetails\CreateOrderDetailsRequest;
use App\Http\Requests\V1\Api\OrderDetails\ReadOrderDetailsByIdRequest;
use App\Http\Requests\V1\Api\OrderDetails\ReadOrderDetailsByOrderIdRequest;
use App\Models\V1\Order;
use App\Models\V1\OrderDetail;
use App\Util\BaseUtil\IdVerificationUtil;
use App\Util\BaseUtil\NotificationUtil;
use App\Util\BaseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;


class OrderDetailsService
{
    use ResponseUtil;
    use NotificationUtil;
    use IdVerificationUtil;

    public function create(CreateOrderDetailsRequest $request): JsonResponse
    {
        try {

            //  validate
            $request->validated($request);
            //  action
            $order = Order::find($request['orderDetailsOrderId']);
            if (!$order) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            $orderDetails = OrderDetail::create(array_merge($request->all());

            //  check if successful
            if (!$orderDetails) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function read(): JsonResponse
    {
        try {
            $orderDetails = OrderDetail::all();
            if (!$orderDetails)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($orderDetails);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readById(ReadOrderDetailsByIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $orderDetails = OrderDetail::where('orderDetailsId', $request['orderDetailsId'])->all();
            if (!$orderDetails) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($orderDetails);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readByOrderId(ReadOrderDetailsByOrderIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $orderDetails = OrderDetail::where('orderDetailsOrderId', $request['orderDetailsOrderId'])->first();
            if (!$orderDetails) throw new ExceptionUtil(ExceptionCase::NOT_SUCCESFULL);
            return  $this->BASE_RESPONSE($orderDetails);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }
}
