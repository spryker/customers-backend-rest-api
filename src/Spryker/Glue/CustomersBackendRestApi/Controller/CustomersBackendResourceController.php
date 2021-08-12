<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi\Controller;

use Generated\Shared\Transfer\CustomerCriteriaTransfer;
use Generated\Shared\Transfer\RestCustomersBackendAttributesTransfer;
use Spryker\Glue\Kernel\Backend\Controller\AbstractBackendController;

/**
 * @method \Spryker\Glue\CustomersBackendRestApi\CustomersBackendRestApiFactory getFactory()
 */
class CustomersBackendResourceController extends AbstractBackendController
{
    /**
     * @Glue({
     *     "type": "customers",
     *     "idAttribute": "idCustomer"
     * })
     *
     * @param \Generated\Shared\Transfer\CustomerCriteriaTransfer $customerCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\RestCustomersBackendAttributesTransfer[]
     */
    public function getAction(CustomerCriteriaTransfer $customerCriteriaTransfer): array
    {
        $transfers = [];
        foreach ($this->getFactory()->getCustomerFacade()->getCustomerCollection($customerCriteriaTransfer)->getCustomers() as $customer) {
            $transfers[] = (new RestCustomersBackendAttributesTransfer())->fromArray($customer->toArray(), true);
        }

        return $transfers;
    }
}
