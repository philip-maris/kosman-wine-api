<?php

namespace App\Http\Service\Vi\Api;

use App\Http\Requests\V1\Api\Order\CreateOrderRequest;
use App\Http\Requests\V1\Api\Order\ReadByOrderIdRequest;
use App\Http\Requests\V1\Api\Order\UpdateOrderRequest;
use App\Mail\OrderSuccessfulMail;
use App\Models\V1\Customer;
use App\Models\V1\Delivery;
use App\Models\V1\Order;
use App\Models\V1\OrderDetail;
use App\Util\BaseUtil\IdVerificationUtil;
use App\Util\BaseUtil\NotificationUtil;
use App\Util\BaseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;


class OrderService
{
    use ResponseUtil;
    use NotificationUtil;
    use IdVerificationUtil;

    public function create(CreateOrderRequest $request): JsonResponse
    {
        try {

            //  validate
            $request->validated($request);
            //  action
            $delivery = Delivery::find($request['orderDeliveryId']);
            if (!$delivery) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            $order = Order::create(array_merge($request->all(),['orderStatus'=>'PENDING']));

            //  check if successful
            if (!$order) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);
            //  send email
            // mark all items in the cart as pending
            $customer = Customer::find($request['orderCustomerId']);
            $email =  Mail::to($customer['customerEmail'])->send(new OrderSuccessfulMail());
            //check if email sent
            if (!$email) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);
// SEND NOTIFICATION
            $this->SEND_NOTIFICATION(
                "{$customer['customerFirstName']} " ." {$customer['customerLastName']} just placed an order",
                'GREEN',$customer->id,'NEW ORDER'
            );

            // create order details
            $orderDetail = OrderDetail::create([
                'orderDetailFirstName'=>$customer['customerFirstName'],
                'orderDetailLastName'=>$customer['customerLastName'],
                'orderDetailOrderId'=>$order['orderId'],
                'orderDetailEmail'=>$customer['customerEmail'],
                'orderDetailPhone'=>$customer['customerPhone'],
                'orderDetailAddress'=>$customer['customerAddress'],
                'orderDetailState'=>$customer['customerState'],
            ]);
            //  check if successful
            if (!$orderDetail) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            $data[] = array_merge($order->toArray(),
                ['orderDetail' => $orderDetail->toArray()]);
            return $this->BASE_RESPONSE($data);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function update(UpdateOrderRequest $request): JsonResponse
    {
        try {
            //  validate
            $request->validated($request);
            // verify adnin
            $customer =  $this->VERIFY_ADMIN($request['customerId']);

             $order = Order::where('orderId', $request['orderId'])->first();
             if (!$order) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            $response =    $order->update(['orderStatus'=>$request['orderStatus']]
            );
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);

            // SEND NOTIFICATION
            $this->SEND_UPDATE_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'], "order {$order['orderId']} to {$request['orderStatus']}", 'Order'
            );

            return $this->SUCCESS_RESPONSE("UPDATE SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }



    public function read(): JsonResponse
    {
        try {
            $order = Order::all();
            if (!$order)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($order);

            //loop through all orders and add order details
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readById(ReadByOrderIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $order = Order::where('orderId', $request['orderId'])->first();
            if (!$order) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            $orderDetail = OrderDetail::where('orderDetailOrderId',$request['orderId']);
            if (!$orderDetail)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);

            $data[] = array_merge($order->toArray(),
                ['orderDetail' => $orderDetail->toArray()]);
            return $this->BASE_RESPONSE($data);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }
}
