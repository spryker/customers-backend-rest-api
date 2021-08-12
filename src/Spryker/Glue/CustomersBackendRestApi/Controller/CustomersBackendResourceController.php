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
     * @param \Generated\Shared\Transfer\CustomerCriteriaTransfer $customerCriteriaTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(CustomerCriteriaTransfer $customerCriteriaTransfer): RestResponseInterface
    {
        return $this->getFactory()->getResourceBuilder()->createRestResponseFromArray(
            $this->getFactory()->getCustomerFacade()->getApiFirstCustomerCollection($customerCriteriaTransfer)->getCustomers(),
            CustomersBackendRestApiConfig::RESOURCE_CUSTOMERS,
            CustomerTransfer::CUSTOMER_REFERENCE
        );
    }

    /**
     * @param string $id
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function patchAction(string $id, CustomerTransfer $customerTransfer): RestResponseInterface
    {
        return $this->getFactory()->getResourceBuilder()->createRestResponseFromArray(
            [
                $this->getFactory()->getCustomerFacade()->updateApiFirstCustomer($id, $customerTransfer)->getCustomerTransfer(),
            ],
            CustomersBackendRestApiConfig::RESOURCE_CUSTOMERS,
            CustomerTransfer::CUSTOMER_REFERENCE
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(CustomerTransfer $customerTransfer): RestResponseInterface
    {
        return $this->getFactory()->getResourceBuilder()->createRestResponseFromArray(
            [
                $this->getFactory()->getCustomerFacade()->createApiFirstCustomer($customerTransfer)->getCustomerTransfer(),
            ],
            CustomersBackendRestApiConfig::RESOURCE_CUSTOMERS,
            CustomerTransfer::CUSTOMER_REFERENCE
        );
    }

    /**
     * @param string $id
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function deleteAction(string $id): RestResponseInterface
    {
        return $this->getFactory()->getResourceBuilder()->createRestResponseFromArray(
            [
                $this->getFactory()->getCustomerFacade()->deleteApiFirstCustomer($id),
            ],
            CustomersBackendRestApiConfig::RESOURCE_CUSTOMERS,
            CustomerTransfer::CUSTOMER_REFERENCE
        );
    }
}
