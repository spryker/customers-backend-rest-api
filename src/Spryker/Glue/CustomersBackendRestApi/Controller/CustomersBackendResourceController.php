<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi\Controller;

use Generated\Shared\Transfer\CustomerCriteriaTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\Kernel\Backend\Controller\AbstractBackendController;

/**
 * @method \Spryker\Glue\CustomersBackendRestApi\CustomersBackendRestApiFactory getFactory()
 */
class CustomersBackendResourceController extends AbstractBackendController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(CustomerCriteriaTransfer $customerCriteriaTransfer): RestResponseInterface
    {
        return $this->getFactory()->createCustomersBackendRestResponseBuilder()->createCustomersCollectionResponse(
            $this->getFactory()->getCustomerFacade()->getCustomerCollection($customerCriteriaTransfer)
        );
    }
}
