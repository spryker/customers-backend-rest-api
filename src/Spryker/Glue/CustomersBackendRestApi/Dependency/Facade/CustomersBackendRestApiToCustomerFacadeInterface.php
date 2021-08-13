<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi\Dependency\Facade;

use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\CustomerCriteriaTransfer;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomersBackendRestApiToCustomerFacadeInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerCriteriaTransfer $customerCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerCollectionTransfer
     */
    public function getCustomerCollection(CustomerCriteriaTransfer $customerCriteriaTransfer): CustomerCollectionTransfer;

    /**
     * @param string $customerReference
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function updateCustomer(string $customerReference, CustomerTransfer $customerTransfer): CustomerResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function createCustomer(CustomerTransfer $customerTransfer): CustomerResponseTransfer;

    /**
     * @param string $customerReference
     *
     * @return CustomerResponseTransfer
     */
    public function deleteCustomer(string $customerReference): CustomerResponseTransfer;
}
