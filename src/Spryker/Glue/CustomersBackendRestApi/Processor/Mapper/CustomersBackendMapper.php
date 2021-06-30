<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\CustomerCriteriaTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\RestCustomersBackendAttributesTransfer;
use Spryker\Glue\CustomersBackendRestApi\CustomersBackendRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomersBackendMapper implements CustomersBackendMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param \Generated\Shared\Transfer\RestCustomersBackendAttributesTransfer $restCustomersBackendAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCustomersBackendAttributesTransfer
     */
    public function mapCustomerTransferToRestCustomerBackendAttributesTransfer(
        CustomerTransfer $customerTransfer,
        RestCustomersBackendAttributesTransfer $restCustomersBackendAttributesTransfer
    ): RestCustomersBackendAttributesTransfer {
        return $restCustomersBackendAttributesTransfer->fromArray($customerTransfer->toArray(), true);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function mapRestRequestToCustomerTransfer(RestRequestInterface $restRequest, CustomerTransfer $customerTransfer): CustomerTransfer
    {
        $customerTransfer->setIdCustomer($restRequest->getResource()->getId());

        return $customerTransfer->fromArray($restRequest->getResource()->getAttributes()->modifiedToArray(), true);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\CustomerCollectionTransfer $customerCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerCollectionTransfer
     */
    public function mapRestRequestToCustomerCollectionTransfer(
        RestRequestInterface $restRequest,
        CustomerCollectionTransfer $customerCollectionTransfer
    ): CustomerCollectionTransfer {
        $filterTransfer = new FilterTransfer();
        if ($restRequest->getPage()) {
            $filterTransfer->setLimit($restRequest->getPage()->getLimit())
                ->setOffset($restRequest->getPage()->getOffset());
        }

        if ($restRequest->getSort()) {
            $filterTransfer->setOrderBy($restRequest->getSort()[0]->getField())
                ->setOrderDirection($restRequest->getSort()[0]->getDirection());
        }

        if ($restRequest->getFilters()) {
            $customerCriteriaTransfer = new CustomerCriteriaTransfer();

            foreach ($restRequest->getFilters() as $resourceType => $filters) {
                if ($resourceType === CustomersBackendRestApiConfig::RESOURCE_CUSTOMERS) {
                    foreach ($filters as $filter) {
                        $setterFunction = 'set' . ucwords($filter->getField());
                        if (
                            property_exists($customerCriteriaTransfer, $filter->getField())
                            && method_exists($customerCriteriaTransfer, $setterFunction)
                        ) {
                            $customerCriteriaTransfer->$setterFunction($filter->getValue());
                        }
                    }
                }
            }

            $customerCollectionTransfer->setCriteria($customerCriteriaTransfer);
        }

        $customerCollectionTransfer->setFilter($filterTransfer);

        return $customerCollectionTransfer;
    }
}
