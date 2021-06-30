<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CustomersBackendRestApi;

use Spryker\Glue\CustomersBackendRestApi\Dependency\Facade\CustomersBackendRestApiToCustomerFacadeInterface;
use Spryker\Glue\CustomersBackendRestApi\Processor\Mapper\CustomersBackendMapper;
use Spryker\Glue\CustomersBackendRestApi\Processor\Mapper\CustomersBackendMapperInterface;
use Spryker\Glue\CustomersBackendRestApi\Processor\Reader\CustomerReader;
use Spryker\Glue\CustomersBackendRestApi\Processor\Reader\CustomerReaderInterface;
use Spryker\Glue\CustomersBackendRestApi\Processor\RestResponseBuilder\CustomersBackendRestResponseBuilder;
use Spryker\Glue\CustomersBackendRestApi\Processor\RestResponseBuilder\CustomersBackendRestResponseBuilderInterface;
use Spryker\Glue\CustomersBackendRestApi\Processor\Updater\CustomerUpdater;
use Spryker\Glue\CustomersBackendRestApi\Processor\Updater\CustomerUpdaterInterface;
use Spryker\Glue\Kernel\Backend\Factory\AbstractBackendFactory;

class CustomersBackendRestApiFactory extends AbstractBackendFactory
{
    /**
     * @return \Spryker\Glue\CustomersBackendRestApi\Processor\Mapper\CustomersBackendMapperInterface
     */
    public function createCustomersBackendMapper(): CustomersBackendMapperInterface
    {
        return new CustomersBackendMapper();
    }

    /**
     * @return \Spryker\Glue\CustomersBackendRestApi\Processor\RestResponseBuilder\CustomersBackendRestResponseBuilderInterface
     */
    public function createCustomersBackendRestResponseBuilder(): CustomersBackendRestResponseBuilderInterface
    {
        return new CustomersBackendRestResponseBuilder(
            $this->getResourceBuilder(),
            $this->createCustomersbackendMapper()
        );
    }

    /**
     * @return \Spryker\Glue\CustomersBackendRestApi\Processor\Reader\CustomerReaderInterface
     */
    public function createCustomerReader(): CustomerReaderInterface
    {
        return new CustomerReader($this->getCustomerFacade(), $this->createCustomersBackendRestResponseBuilder(), $this->createCustomersBackendMapper());
    }

    /**
     * @return \Spryker\Glue\CustomersBackendRestApi\Dependency\Facade\CustomersBackendRestApiToCustomerFacadeInterface
     */
    public function getCustomerFacade(): CustomersBackendRestApiToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomersBackendRestApiDependencyProvider::FACADE_CUSTOMER);
    }

    /**
     * @return \Spryker\Glue\CustomersBackendRestApi\Processor\Updater\CustomerUpdaterInterface
     */
    public function createCustomerUpdater(): CustomerUpdaterInterface
    {
        return new CustomerUpdater($this->getCustomerFacade(), $this->createCustomersBackendRestResponseBuilder(), $this->createCustomersBackendMapper());
    }
}
