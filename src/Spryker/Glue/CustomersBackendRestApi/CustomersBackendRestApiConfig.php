<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace Spryker\Glue\CustomersBackendRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CustomersBackendRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_CUSTOMERS = 'customers';

    /**
     * @uses \Spryker\Shared\Customer\Code\Messages::CUSTOMER_EMAIL_ALREADY_USED
     */
    public const CUSTOMER_EMAIL_ALREADY_USED = 'customer.email.already.used';
    /**
     * @uses \Spryker\Shared\Customer\Code\Messages::CUSTOMER_EMAIL_FORMAT_INVALID
     */
    public const CUSTOMER_EMAIL_FORMAT_INVALID = 'customer.email.format.invalid';
    /**
     * @uses \Spryker\Shared\Customer\Code\Messages::CUSTOMER_EMAIL_INVALID
     */
    public const CUSTOMER_EMAIL_INVALID = 'customer.email.invalid';
    /**
     * @uses \Spryker\Shared\Customer\Code\Messages::CUSTOMER_EMAIL_TOO_LONG
     */
    public const CUSTOMER_EMAIL_TOO_LONG = 'customer.email.length.exceeded';
}
