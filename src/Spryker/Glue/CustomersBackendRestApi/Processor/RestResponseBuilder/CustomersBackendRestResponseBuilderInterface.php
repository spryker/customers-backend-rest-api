<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi\Processor\RestResponseBuilder;

use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface CustomersBackendRestResponseBuilderInterface
{
    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCustomerNotFoundResponse(): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createNotImplementedResponse(): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCustomerResponse(CustomerTransfer $customerTransfer): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\CustomerCollectionTransfer $customerCollectionTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCustomersCollectionResponse(CustomerCollectionTransfer $customerCollectionTransfer): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\CustomerResponseTransfer $customerResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createUpdateFailedResponse(CustomerResponseTransfer $customerResponseTransfer): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createBadRequestResponse(): RestResponseInterface;
}
