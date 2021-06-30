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
     * @param \Generated\Shared\Transfer\CustomerCriteriaTransfer $customerCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function getCustomerByCriteria(CustomerCriteriaTransfer $customerCriteriaTransfer): CustomerResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function updateCustomer(CustomerTransfer $customerTransfer);

    /**
     * @param \Generated\Shared\Transfer\CustomerCollectionTransfer $customerCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerCollectionTransfer
     */
    public function getCustomerCollection(CustomerCollectionTransfer $customerCollectionTransfer): CustomerCollectionTransfer;
}
