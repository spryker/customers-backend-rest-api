<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi\Processor\Reader;

use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\CustomerCriteriaTransfer;
use Spryker\Glue\CustomersBackendRestApi\Dependency\Facade\CustomersBackendRestApiToCustomerFacadeInterface;
use Spryker\Glue\CustomersBackendRestApi\Processor\Mapper\CustomersBackendMapperInterface;
use Spryker\Glue\CustomersBackendRestApi\Processor\RestResponseBuilder\CustomersBackendRestResponseBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class CustomerReader implements CustomerReaderInterface
{
    /**
     * @var \Spryker\Glue\CustomersBackendRestApi\Dependency\Facade\CustomersBackendRestApiToCustomerFacadeInterface
     */
    protected $customerFacade;

    /**
     * @var \Spryker\Glue\CustomersBackendRestApi\Processor\RestResponseBuilder\CustomersBackendRestResponseBuilderInterface
     */
    protected $customersBackendRestResponseBuilder;

    /**
     * @var \Spryker\Glue\CustomersBackendRestApi\Processor\Mapper\CustomersBackendMapperInterface
     */
    protected $customerBackendMapper;

    /**
     * @param \Spryker\Glue\CustomersBackendRestApi\Dependency\Facade\CustomersBackendRestApiToCustomerFacadeInterface $customerFacade
     * @param \Spryker\Glue\CustomersBackendRestApi\Processor\RestResponseBuilder\CustomersBackendRestResponseBuilderInterface $customersBackendRestResponseBuilder
     * @param \Spryker\Glue\CustomersBackendRestApi\Processor\Mapper\CustomersBackendMapperInterface $customerBackendMapper
     */
    public function __construct(
        CustomersBackendRestApiToCustomerFacadeInterface $customerFacade,
        CustomersBackendRestResponseBuilderInterface $customersBackendRestResponseBuilder,
        CustomersBackendMapperInterface $customerBackendMapper
    ) {
        $this->customerFacade = $customerFacade;
        $this->customersBackendRestResponseBuilder = $customersBackendRestResponseBuilder;
        $this->customerBackendMapper = $customerBackendMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getCustomer(RestRequestInterface $restRequest): RestResponseInterface
    {
        $customerResponseTransfer = $this->customerFacade->getCustomerByCriteria(
            (new CustomerCriteriaTransfer())->setIdCustomer($restRequest->getResource()->getId())
        );

        if (!$customerResponseTransfer->getHasCustomer()) {
            return $this->customersBackendRestResponseBuilder->createCustomerNotFoundResponse();
        }

        return $this->customersBackendRestResponseBuilder->createCustomerResponse($customerResponseTransfer->getCustomerTransfer());
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getCustomers(RestRequestInterface $restRequest): RestResponseInterface
    {
        $customerCollectionTransfer = $this->customerFacade->getCustomerCollection(
            $this->customerBackendMapper->mapRestRequestToCustomerCollectionTransfer($restRequest, (new CustomerCollectionTransfer()))
        );

        return $this->customersBackendRestResponseBuilder->createCustomersCollectionResponse($customerCollectionTransfer);
    }
}
