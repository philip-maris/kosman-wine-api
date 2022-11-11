<?php

namespace App\Http\Service;

use App\Http\Requests\OrderItems\CreateOrderItemsRequest;
use App\Http\Requests\OrderItems\ReadOrderItemsByIdRequest;
use App\Http\Requests\OrderItems\ReadOrderItemsByOrderIdRequest;
use App\Models\Order;
use App\Models\OrderItems;
use App\Util\baseUtil\IdVerificationUtil;
use App\Util\baseUtil\NotificationUtil;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;


class OrderItemsService
{
    use ResponseUtil;
    use NotificationUtil;
    use IdVerificationUtil;

    public function create(CreateOrderItemsRequest $request): JsonResponse
    {
        try {

            //  validate
            $request->validated($request);
            //  action
            $order = Order::find($request['orderItemsOrderId']);
            if (!$order) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            $orderItems = OrderItems::create(array_merge($request->all());

            //  check if successful
            if (!$orderItems) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function read(): JsonResponse
    {
        try {
            $orderItems = OrderItems::all();
            if (!$orderItems)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($orderItems);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readById(ReadOrderItemsByIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $orderItem = OrderItems::where('orderItemsId', $request['orderItemsId'])->all();
            if (!$orderItem) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($orderItem);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readByOrderId(ReadOrderItemsByOrderIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $orderItem = OrderItems::where('orderItemsOrderId', $request['orderItemsOrderId'])->first();
            if (!$orderItem) throw new ExceptionUtil(ExceptionCase::NOT_SUCCESFULL);
            return  $this->BASE_RESPONSE($orderItem);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }
}
