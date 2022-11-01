<?php

namespace App\Http\Controllers;


use App\Http\Requests\Notification\ReadByNotificationIdRequest;
use App\Http\Requests\Notification\ReadByCustomerTypeRequest;
use App\Http\Requests\Testimony\CreateNotificationRequest;
use App\Http\Service\NotificationService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    use ResponseUtil;

    public function __construct(protected NotificationService $notificationService){
        //todo code here
    }


    public function create(CreateNotificationRequest $request): JsonResponse
    {
      return  $this->notificationService->create($request);
    }

    public function read(): JsonResponse
    {

        return $this->notificationService->read();
    }

    public function readById(ReadByNotificationIdRequest $request): JsonResponse
    {
       return $this->notificationService->readById($request);
    }

    public function readByCustomerType(ReadByCustomerTypeRequest $request): JsonResponse
    {
       return $this->notificationService->readByCustomerType($request);
    }
}
