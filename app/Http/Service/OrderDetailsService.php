<?php

namespace App\Http\Service;

use App\Http\Requests\OrderDetails\CreateOrderDetailsRequest;
use App\Http\Requests\OrderDetails\ReadOrderDetailsByIdRequest;
use App\Http\Requests\OrderDetails\ReadOrderDetailsByOrderIdRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Util\baseUtil\IdVerificationUtil;
use App\Util\baseUtil\NotificationUtil;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;


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

            $orderDetails = OrderDetails::create(array_merge($request->all());

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
            $orderDetails = OrderDetails::all();
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
            $orderDetails = OrderDetails::where('orderDetailsId', $request['orderDetailsId'])->all();
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
            $orderDetails = OrderDetails::where('orderDetailsOrderId', $request['orderDetailsOrderId'])->first();
            if (!$orderDetails) throw new ExceptionUtil(ExceptionCase::NOT_SUCCESFULL);
            return  $this->BASE_RESPONSE($orderDetails);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }
}
