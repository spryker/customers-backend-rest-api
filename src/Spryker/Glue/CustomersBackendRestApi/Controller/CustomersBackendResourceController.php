<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi\Controller;

use Generated\Shared\Transfer\CustomerCriteriaTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Glue\CustomersBackendRestApi\CustomersBackendRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\Kernel\Backend\Controller\AbstractBackendController;

/**
 * @method \Spryker\Glue\CustomersBackendRestApi\CustomersBackendRestApiFactory getFactory()
 */
class CustomersBackendResourceController extends AbstractBackendController
{
    /**
     * - <DomainEntity>CriteriaTransfer in getAction does the following:
     *  - query parameter filter is mapped to <DomainEntity>CriteriaTransfer.<DomainEntity>Conditions
     *  - query parameter sort (-field for descending sort) is mapped to <DomainEntity>CriteriaTransfer.SortCollection
     *  - query parameter page (limit/offset) is mapped to <DomainEntity>CriteriaTransfer.Pagination
     *
     * @param \Generated\Shared\Transfer\CustomerCriteriaTransfer $customerCriteriaTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(CustomerCriteriaTransfer $customerCriteriaTransfer): RestResponseInterface
    {
        return $this->getFactory()->getResourceBuilder()->createRestResponseFromArray(
            $this->getFactory()->getCustomerFacade()->getCustomerCollection($customerCriteriaTransfer)->getCustomers(),
            CustomersBackendRestApiConfig::RESOURCE_CUSTOMERS,
            CustomerTransfer::CUSTOMER_REFERENCE
        );
    }

    /**
     * - string attributes in patchAction gets path identifier by order
     * - /test/1/test2/2/test3/customers/DE--1 -> string $test1, string $test2, string $test3, string $customerReference
     * - business transfer object in patchAction gets mapped to via infrastructure from data.attributes
     *
     * @param string $customerReference
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function patchAction(string $customerReference, CustomerTransfer $customerTransfer): RestResponseInterface
    {
        return $this->getFactory()->getResourceBuilder()->createRestResponseFromArray(
            [
                $this->getFactory()->getCustomerFacade()->updateCustomer($customerReference, $customerTransfer)->getCustomerTransfer(),
            ],
            CustomersBackendRestApiConfig::RESOURCE_CUSTOMERS,
            CustomerTransfer::CUSTOMER_REFERENCE
        );
    }

    /**
     * - string attributes in patchAction gets path identifier by order
     * - /test/1/test2/2/test3/customers/DE--1 -> string $test1, string $test2, string $test3, string $customerReference
     * - business transfer object in patchAction gets mapped to via infrastructure from data.attributes
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(CustomerTransfer $customerTransfer): RestResponseInterface
    {
        return $this->getFactory()->getResourceBuilder()->createRestResponseFromArray(
            [
                $this->getFactory()->getCustomerFacade()->createCustomer($customerTransfer)->getCustomerTransfer(),
            ],
            CustomersBackendRestApiConfig::RESOURCE_CUSTOMERS,
            CustomerTransfer::CUSTOMER_REFERENCE
        );
    }

    /**
     * - string attributes in patchAction gets path identifier by order
     * - /test/1/test2/2/test3/customers/DE--1 -> string $test1, string $test2, string $test3, string $customerReference
     * 
     * @param string $id
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function deleteAction(string $id): RestResponseInterface
    {
        return $this->getFactory()->getResourceBuilder()->createRestResponseFromArray(
            [
                $this->getFactory()->getCustomerFacade()->deleteCustomer($id),
            ],
            CustomersBackendRestApiConfig::RESOURCE_CUSTOMERS,
            CustomerTransfer::CUSTOMER_REFERENCE
        );
    }
}
