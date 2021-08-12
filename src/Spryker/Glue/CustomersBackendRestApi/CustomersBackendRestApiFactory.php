<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi;

use Spryker\Glue\CustomersBackendRestApi\Dependency\Facade\CustomersBackendRestApiToCustomerFacadeInterface;
use Spryker\Glue\Kernel\Backend\Factory\AbstractBackendFactory;

class CustomersBackendRestApiFactory extends AbstractBackendFactory
{
    /**
     * @return \Spryker\Glue\CustomersBackendRestApi\Dependency\Facade\CustomersBackendRestApiToCustomerFacadeInterface
     */
    public function getCustomerFacade(): CustomersBackendRestApiToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomersBackendRestApiDependencyProvider::FACADE_CUSTOMER);
    }
}
