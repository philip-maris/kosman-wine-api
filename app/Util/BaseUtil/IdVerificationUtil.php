<?php

namespace App\Util\BaseUtil;

use App\Models\Notification;
use App\Models\V1\Customer;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;

trait IdVerificationUtil{

    /**
     * @throws ExceptionUtil
     */
    public function VERIFY_ADMIN(string $customerId)
   {
       $customer = Customer::find($customerId);
       if (!$customer) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "INVALID CUSTOMER ID");
       //CHECK IF IS ADMIN
       if (!($customer['isAdmin'] | $customer['isSuperAdmin']))
           throw new ExceptionUtil(ExceptionCase::UNAUTHORIZED, "NOT AN ADMIN OR SUPER ADMIN");

       return $customer;
   }

}
