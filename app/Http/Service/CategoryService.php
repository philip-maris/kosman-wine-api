<?php

namespace App\Http\Service;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\ReadByIdCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Util\baseUtil\IdVerificationUtil;
use App\Util\baseUtil\NotificationUtil;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class CategoryService
{
    use ResponseUtil;
    use NotificationUtil;
    use IdVerificationUtil;

    public function create(CreateCategoryRequest $request){
        try {
            //TODO VALIDATION
            $request->validated($request);
            // verify admin
            $customer = $this->VERIFY_ADMIN($request['categoryCustomerId']);

            $response = Category::create(array_merge($request->all(),
                ['categoryStatus'=>'ACTIVE']));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            // SEND NOTIFICATION
            $this->SEND_CREATION_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'],$response['categoryName'],'Category'
            );
            return $this->SUCCESS_RESPONSE("CATEGORY CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function update(UpdateCategoryRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request);
            // verify admin
            $customer = $this->VERIFY_ADMIN($request['customerId']);

            $category = Category::find($request['categoryId']);
            $response = $category->update(array_merge($request->except('categoryId'),
                ['categoryStatus'=>'ACTIVE']));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);

            // SEND NOTIFICATION
            $this->SEND_UPDATE_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'],$category['categoryName'],'Category'
            );
            return  $this->SUCCESS_RESPONSE("CATEGORY UPDATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }
    public function read(): JsonResponse
    {
        try {
            $categories = Category::all();
            if (!$categories)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($categories);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function readById(ReadByIdCategoryRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            //todo action
            $category = Category::where('categoryId', $request['categoryId'])->first();
            if (!$category) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($category);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function delete(ReadByIdCategoryRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            // verify admin
            $customer = $this->VERIFY_ADMIN($request['customerId']);

            $category = Category::where('categoryId', $request['categoryId'])->first();
            if (!$category) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            if (!$category->delete()) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            // SEND NOTIFICATION
            $this->SEND_DELETE_NOTIFICATION(
                "{$customer['customerFirstName']} " . "{$customer['customerLastName']}",
                $customer['customerId'],$category['categoryName'],'Category'
            );
            return  $this->SUCCESS_RESPONSE("CATEGORY DELETED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

}
