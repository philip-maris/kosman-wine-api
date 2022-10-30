<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\CreateTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Http\Requests\Transaction\ReadByIdRequest;
use App\Http\Service\transactionService;
use App\Models\Transaction;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    use ResponseUtil;

    public function __construct(protected TransactionService $transactionService){
        $this->transactionService = $transactionService;
    }


    public function create(CreateTransactionRequest $request): JsonResponse
    {
      return  $this->transactionService->create($request);
    }

    public function read(): JsonResponse
    {

        return $this->transactionService->read();
    }

    public function readById(ReadByIdRequest $request): JsonResponse
    {
       return $this->transactionService->readById($request);
    }
}
