<?php

namespace App\Http\Controllers;


use App\Http\Requests\Notification\ReadByIdRequest;
use App\Http\Requests\Notification\ReadByCustomerTypeRequest;
use App\Http\Requests\Testimony\CreateNotificationRequest;
use App\Http\Service\notificationService;
use App\Models\Notification;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    use ResponseUtil;

    public function __construct(protected NotificationService $notificationService){
        $this->notificationService = $notificationService;
    }


    public function create(CreateNotificationRequest $request): JsonResponse
    {
      return  $this->notificationService->create($request);
    }

    public function read(): JsonResponse
    {

        return $this->notificationService->read();
    }

    public function readById(ReadByIdRequest $request): JsonResponse
    {
       return $this->notificationService->readById($request);
    }

    public function readByCustomerType(ReadByCustomerTypeRequest $request): JsonResponse
    {
       return $this->notificationService->readByCustomerType($request);
    }
}
