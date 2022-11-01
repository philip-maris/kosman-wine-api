<?php

namespace App\Http\Service;

use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\ReadByBrandIdRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Models\Brand;
use App\Util\baseUtil\IdVerificationUtil;
use App\Util\baseUtil\NotificationUtil;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class BrandService
{
    use ResponseUtil;
    use NotificationUtil;
    use IdVerificationUtil;

    public function create(CreateBrandRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request);

            // verify adnin
            $customer = $this->VERIFY_ADMIN($request['customerId']);

            $response = Brand::create(array_merge($request->all(),
                ['brandStatus' => 'ACTIVE']));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            $this->SEND_CREATION_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'], $response['brandName'], 'Brand'
            );
            return $this->SUCCESS_RESPONSE("BRAND CREATED SUCCESSFUL");
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function update(UpdateBrandRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request);

            // verify adnin
            $customer = $this->VERIFY_ADMIN($request['customerId']);

            $brand = Brand::find($request['brandId']);
            if (!$brand) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            $response = $brand->update(array_merge($request->except('brandId'),
                ['brandStatus' => 'ACTIVE']));

            // SEND NOTIFICATION
            $this->SEND_UPDATE_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'], $brand['brandName'], 'Brand'
            );
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);
            return $this->SUCCESS_RESPONSE("BRAND UPDATED SUCCESSFUL");
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function read(): JsonResponse
    {
        try {
            $brand = Brand::all();
            if (!$brand) throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($brand);
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function readById(ReadByBrandIdRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            //todo action
            $brand = Brand::where('brandId', $request['brandId'])->first();
            if (!$brand) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return $this->BASE_RESPONSE($brand);
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function delete(ReadByBrandIdRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
              // verify admin
            $customer = $this->VERIFY_ADMIN($request['customerId']);

            $brand = Brand::where('brandId', $request['brandId'])->first();
            if (!$brand) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            if (!$brand->delete()) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            // SEND NOTIFICATION
            $this->SEND_DELETE_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'], $brand['brandName'], 'Brand'
            );

            return $this->SUCCESS_RESPONSE("BRAND DELETED SUCCESSFUL");
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }
}
