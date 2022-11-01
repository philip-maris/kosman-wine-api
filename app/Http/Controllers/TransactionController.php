<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\CreateTransactionRequest;
use App\Http\Requests\Transaction\ReadByTransactionIdRequest;
use App\Http\Service\TransactionService;
use App\Util\baseUtil\ResponseUtil;
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
