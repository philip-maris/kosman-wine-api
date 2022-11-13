<?php

namespace App\Http\Service\Vi\Api;

use App\Http\Requests\V1\Api\Cart\CreateCartRequest;
use App\Http\Requests\V1\Api\Cart\ReadByCartIdRequest;
use App\Http\Requests\V1\Api\Cart\ReadByCustomerIdRequest;
use App\Http\Requests\V1\Api\Cart\UpdateCartRequest;
use App\Models\V1\Cart;
use App\Models\V1\Product;
use App\Util\BaseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;


class CartService
{
    use ResponseUtil;
    public function __construct(protected ProductService $productService){

    }

    public function create(CreateCartRequest $request): JsonResponse
    {
        try {

            //  validate
            $request->validated();

            //  check if requested product quantity is available
            $product = Product::find($request['cartProductId']);
            if (!$product) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            if (($product['productQuantity'] - $request['cartAddedQuantity']) < 0) {
                throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG , "{$product['productQuantity']}  available");
            }

            $cart = Cart::create($request->all());

            //todo  check if successful
            if (!$cart) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("CART CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function update(UpdateCartRequest $request): JsonResponse
    {
        try {
            //  validate
            $request->validated($request->all());

             $cart = Cart::find($request['cartCustomerId']);
             $product = Product::find($request['cartProductId']);
             if (!$product || !$cart) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            //  check if requested product quantity is available
            if (($product['productQuantity'] - $request['cartAddedQuantity']) < 0) {
                throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG , "{$product['productQuantity']} available");
            }

            //todo update the cart
            $response =    $cart->update($request->only('cartAddedQuantity'));

            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);

            return $this->SUCCESS_RESPONSE("UPDATE SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }



    public function read(): JsonResponse
    {
        try {
            $cart = Cart::all();
            if (!$cart)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($cart);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readByCustomerId(ReadByCustomerIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $cart = Cart::where('cartCustomerId', $request['cartCustomerId'])->first();
            if (!$cart) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($cart);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }



    public function delete(ReadByCartIdRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            $cart = Cart::where('cartId', $request['cartId'])->first();
            if (!$cart) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            if (!$cart->delete()) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);
            return  $this->SUCCESS_RESPONSE("CART REFRESH SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }
}
