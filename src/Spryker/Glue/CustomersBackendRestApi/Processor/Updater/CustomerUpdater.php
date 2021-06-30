<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi\Processor\Updater;

use \Exception;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Glue\CustomersBackendRestApi\CustomersBackendRestApiConfig;
use Spryker\Glue\CustomersBackendRestApi\Dependency\Facade\CustomersBackendRestApiToCustomerFacadeInterface;
use Spryker\Glue\CustomersBackendRestApi\Processor\Mapper\CustomersBackendMapperInterface;
use Spryker\Glue\CustomersBackendRestApi\Processor\RestResponseBuilder\CustomersBackendRestResponseBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerUpdater implements CustomerUpdaterInterface
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
    public function updateCustomer(RestRequestInterface $restRequest): RestResponseInterface
    {
        try {
            $customerResponseTransfer = $this->customerFacade->updateCustomer(
                $this->customerBackendMapper->mapRestRequestToCustomerTransfer($restRequest, new CustomerTransfer())
            );

            if (!$customerResponseTransfer->getIsSuccess()) {
                return $this->customersBackendRestResponseBuilder->createUpdateFailedResponse($customerResponseTransfer);
            }

            return $this->customersBackendRestResponseBuilder->createCustomerResponse($customerResponseTransfer->getCustomerTransfer());
        } catch (Exception $e) {
            return $this->customersBackendRestResponseBuilder->createBadRequestResponse();
        }
    }
}
