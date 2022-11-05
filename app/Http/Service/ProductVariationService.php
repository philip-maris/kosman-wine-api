<?php

namespace App\Http\Service;

use App\Http\Requests\ProductVariation\CreateProductVariationRequest;
use App\Http\Requests\ProductVariation\ReadByProductVariationIdRequest;
use App\Http\Requests\ProductVariation\UpdateProductVariationRequest;
use App\Models\ProductVariation;
use App\Util\baseUtil\IdVerificationUtil;
use App\Util\baseUtil\NotificationUtil;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use \Illuminate\Http\JsonResponse;


class ProductVariationService
{
    use ResponseUtil;
    use IdVerificationUtil;
    use NotificationUtil;

    public function create(CreateProductVariationRequest $request): JsonResponse
    {
        try {
            //todo validate
            $request->validated($request);
            // verify adnin
            $customer = $this->VERIFY_ADMIN($request['productVariationCustomerId']);

            $response = ProductVariation::create(array_merge($request->all(),
                ['productVariationStatus' => 'ACTIVE']));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            $this->SEND_CREATION_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'], $response['productVariationSize'], 'ProductVariation'
            );

            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function update(UpdateProductVariationRequest $request): JsonResponse
    {
        try {
            //todo validate
            $request->validated($request);

            // verify adnin
            $customer = $this->VERIFY_ADMIN($request['productVariationCustomerId']);

             $productVariation = ProductVariation::where('productVariationId', $request['productVariationId'])->first();
             if (!$productVariation) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            $response = $productVariation->update(array_merge($request->except('productVariationId'),
                ['productVariationStatus' => 'ACTIVE']));

            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);

            // SEND NOTIFICATION
            $this->SEND_UPDATE_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'],$productVariation['productVariationSize'],'ProductVariation'
            );

            return $this->SUCCESS_RESPONSE("UPDATE SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }



    public function read(): JsonResponse
    {
        try {
            $productVariation = ProductVariation::all();
            if (!$productVariation)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($productVariation);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readById(ReadByProductVariationIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $productVariation = ProductVariation::where('productVariationId', $request['productVariationId'])->first();
            if (!$productVariation) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($productVariation);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }
}
