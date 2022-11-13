<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Transaction\CreateTransactionRequest;
use App\Http\Requests\V1\Api\Transaction\ReadByTransactionIdRequest;
use App\Http\Service\Vi\Api\TransactionService;
use App\Util\BaseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    use ResponseUtil;

    public function __construct(protected TransactionService $transactionService){
        //todo code here
    }


    public function create(CreateTransactionRequest $request): JsonResponse
    {
      return  $this->transactionService->create($request);
    }

    public function read(): JsonResponse
    {

        return $this->transactionService->read();
    }

    public function readById(ReadByTransactionIdRequest $request): JsonResponse
    {
       return $this->transactionService->readById($request);
    }
}
