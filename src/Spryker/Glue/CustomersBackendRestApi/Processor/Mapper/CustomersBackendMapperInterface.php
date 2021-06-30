<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCustomersBackendAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CustomersBackendMapperInterface
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
    ): RestCustomersBackendAttributesTransfer;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function mapRestRequestToCustomerTransfer(RestRequestInterface $restRequest, CustomerTransfer $customerTransfer): CustomerTransfer;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\CustomerCollectionTransfer $customerCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerCollectionTransfer
     */
    public function mapRestRequestToCustomerCollectionTransfer(
        RestRequestInterface $restRequest,
        CustomerCollectionTransfer $customerCollectionTransfer
    ): CustomerCollectionTransfer;
}
