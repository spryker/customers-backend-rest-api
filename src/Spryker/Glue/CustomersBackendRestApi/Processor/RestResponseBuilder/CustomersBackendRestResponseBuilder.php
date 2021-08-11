<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi\Processor\RestResponseBuilder;

use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCustomersBackendAttributesTransfer;
use Spryker\Glue\CustomersBackendRestApi\CustomersBackendRestApiConfig;
use Spryker\Glue\CustomersBackendRestApi\Processor\Mapper\CustomersBackendMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class CustomersBackendRestResponseBuilder implements CustomersBackendRestResponseBuilderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \Spryker\Glue\CustomersBackendRestApi\Processor\Mapper\CustomersBackendMapperInterface
     */
    protected $customersBackendMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \Spryker\Glue\CustomersBackendRestApi\Processor\Mapper\CustomersBackendMapperInterface $customersBackendMapper
     */
    public function __construct(RestResourceBuilderInterface $restResourceBuilder, CustomersBackendMapperInterface $customersBackendMapper)
    {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->customersBackendMapper = $customersBackendMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerCollectionTransfer $customerCollectionTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCustomersCollectionResponse(CustomerCollectionTransfer $customerCollectionTransfer): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        foreach ($customerCollectionTransfer->getCustomers() as $customerTransfer) {
            $restResource = $this->createCustomerResource($customerTransfer);
            $restResponse->addResource($restResource);
        }

        return $restResponse;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected function createCustomerResource(
        CustomerTransfer $customerTransfer
    ): RestResourceInterface {
        $restCustomersBackendAttributesTransfer = $this
            ->customersBackendMapper
            ->mapCustomerTransferToRestCustomerBackendAttributesTransfer(
                $customerTransfer,
                new RestCustomersBackendAttributesTransfer()
            );

        return $this->restResourceBuilder->createRestResource(
            CustomersBackendRestApiConfig::RESOURCE_CUSTOMERS,
            $customerTransfer->getIdCustomer(),
            $restCustomersBackendAttributesTransfer
        );
    }
}
