<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi\Processor\RestResponseBuilder;

use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCustomersBackendAttributesTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\CustomersBackendRestApi\CustomersBackendRestApiConfig;
use Spryker\Glue\CustomersBackendRestApi\Processor\Mapper\CustomersBackendMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

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
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCustomerNotFoundResponse(): RestResponseInterface
    {
        return $this->restResourceBuilder->createRestResponse()
            ->setStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createNotImplementedResponse(): RestResponseInterface
    {
        return $this->restResourceBuilder->createRestResponse()
            ->setStatus(Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCustomerResponse(
        CustomerTransfer $customerTransfer
    ): RestResponseInterface {
        $restResource = $this->createCustomerResource($customerTransfer);

        $restResponse = $this->restResourceBuilder->createRestResponse();
        $restResponse->addResource($restResource);

        return $restResponse;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerCollectionTransfer $customerCollectionTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCustomersCollectionResponse(CustomerCollectionTransfer $customerCollectionTransfer): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        foreach($customerCollectionTransfer->getCustomers() as $customerTransfer) {
            $restResource = $this->createCustomerResource($customerTransfer);
            $restResponse->addResource($restResource);
        }

        return $restResponse;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerResponseTransfer $customerResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createUpdateFailedResponse(CustomerResponseTransfer $customerResponseTransfer): RestResponseInterface
    {
        foreach ($customerResponseTransfer->getErrors() as $error) {
            if ($error->getMessage() === CustomersBackendRestApiConfig::CUSTOMER_EMAIL_ALREADY_USED) {
                return $this->restResourceBuilder->createRestResponse()
                    ->addError((new RestErrorMessageTransfer())->setDetail('Email already in use'))
                    ->setStatus(Response::HTTP_BAD_REQUEST);
            }

            if ($error->getMessage() === CustomersBackendRestApiConfig::CUSTOMER_EMAIL_FORMAT_INVALID) {
                return $this->restResourceBuilder->createRestResponse()
                    ->addError((new RestErrorMessageTransfer())->setDetail('Invalid email format'))
                    ->setStatus(Response::HTTP_BAD_REQUEST);
            }

            if ($error->getMessage() === CustomersBackendRestApiConfig::CUSTOMER_EMAIL_INVALID) {
                return $this->restResourceBuilder->createRestResponse()
                    ->addError((new RestErrorMessageTransfer())->setDetail('Invalid email'))
                    ->setStatus(Response::HTTP_BAD_REQUEST);
            }

            if ($error->getMessage() === CustomersBackendRestApiConfig::CUSTOMER_EMAIL_TOO_LONG) {
                return $this->restResourceBuilder->createRestResponse()
                    ->addError((new RestErrorMessageTransfer())->setDetail('Email is too long'))
                    ->setStatus(Response::HTTP_BAD_REQUEST);
            }
        }

        return $this->createBadRequestResponse();
    }

    public function createBadRequestResponse(): RestResponseInterface
    {
        return $this->restResourceBuilder->createRestResponse()
            ->setStatus(Response::HTTP_BAD_REQUEST);
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
