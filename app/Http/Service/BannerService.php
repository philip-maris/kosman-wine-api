<?php

namespace App\Http\Service;

use App\Http\Requests\Banner\CreateBannerRequest;
use App\Http\Requests\Banner\ReadByBannerIdRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Models\Banner;
use App\Util\baseUtil\IdVerificationUtil;
use App\Util\baseUtil\ResponseUtil;
use App\Util\baseUtil\NotificationUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use \Illuminate\Http\JsonResponse;


class BannerService
{
    use ResponseUtil;
    use NotificationUtil;
    use IdVerificationUtil;


    public function create(CreateBannerRequest $request): JsonResponse
    {
        try {

            //todo validate
            $request->validated($request);

            // verify admin
           // $customer = $this->VERIFY_ADMIN($request['bannerCustomerId']);

            $banner = Banner::create(array_merge($request->all(),
                ['bannerStatus' => 'ACTIVE']));
            //todo check its successful
            if (!$banner) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            // SEND NOTIFICATION


            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function update(UpdateBannerRequest $request): JsonResponse
    {
        try {
            //  validate
            $request->validated($request);
            // verify adnin
           // $customer =  $this->VERIFY_ADMIN($request['bannerCustomerId']);

            $banner = Banner::where('bannerId', $request['bannerId'])->first();
            if (!$banner) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, 'INVALID BANNER ID');
            $response = $banner->update(array_merge($request->except('bannerId'),
                ['bannerStatus' => 'ACTIVE']));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);

            // SEND NOTIFICATION
//            $this->SEND_UPDATE_NOTIFICATION(
//                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
//                $customer['customerId'],'','BANNER'
//            );


            return $this->SUCCESS_RESPONSE("UPDATE SUCCESSFUL");
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }


    public function read(): JsonResponse
    {
        try {
            $banner = Banner::all();
            if (!$banner) throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($banner);
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readById(ReadByBannerIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $banner = Banner::where('bannerId', $request['bannerId'])->first();
            if (!$banner) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return $this->BASE_RESPONSE($banner);
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

}
