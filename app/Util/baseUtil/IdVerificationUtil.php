<?php

namespace App\Util\baseUtil;

use App\Models\Customer;
use App\Models\Notification;
use App\Util\exceptionUtil\ExceptionUtil;

use App\Util\exceptionUtil\ExceptionCase;

trait IdVerificationUtil{
   public function VERIFY_ADMIN(string $customerId):Customer
    {
        $customer = Customer::find($customerId);
        if (!$customer) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "INVALID CUSTOMER ID");
        //CHECK IF IS ADMIN
        if (!($customer['isAdmin'] | $customer['isSuperAdmin']))
            throw new ExceptionUtil(ExceptionCase::UNAUTHORIZED, "NOT AN ADMIN OR SUPER ADMIN");

        return $customer;
    }
}
