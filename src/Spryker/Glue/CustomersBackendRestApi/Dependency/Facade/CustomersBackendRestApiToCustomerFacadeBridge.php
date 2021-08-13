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

class CustomersBackendRestApiToCustomerFacadeBridge implements CustomersBackendRestApiToCustomerFacadeInterface
{
    /**
     * @var \Spryker\Zed\Customer\Business\CustomerFacadeInterface
     */
    protected $customerFacade;

    /**
     * @param \Spryker\Zed\Customer\Business\CustomerFacadeInterface $customerFacade
     */
    public function __construct($customerFacade)
    {
        $this->customerFacade = $customerFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerCriteriaTransfer $customerCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerCollectionTransfer
     */
    public function getCustomerCollection(CustomerCriteriaTransfer $customerCriteriaTransfer): CustomerCollectionTransfer
    {
        return $this->customerFacade->getCustomerCollection($customerCriteriaTransfer);
    }

    /**
     * @param string $customerReference
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function updateCustomer(string $customerReference, CustomerTransfer $customerTransfer): CustomerResponseTransfer
    {
        return $this->customerFacade->updateCustomer($customerReference, $customerTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function createCustomer(CustomerTransfer $customerTransfer): CustomerResponseTransfer
    {
        return $this->customerFacade->createCustomer($customerTransfer);
    }

    /**
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function deleteCustomer(string $customerReference): CustomerResponseTransfer
    {
        return $this->customerFacade->deleteCustomer($customerReference);
    }
}
