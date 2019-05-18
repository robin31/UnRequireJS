<?php

namespace Robin31\UnRequireJS\Model\Amazon;

use Magento\Store\Model\ScopeInterface;
use Robin31\UnRequireJS\Model\AbstractUnloader;

class LoginUnloader extends AbstractUnloader
{

    /**
     * Config location of active setting of Amazon_Payment payment method module.
     */
    const XML_PATH_AMAZON_PAYMENT_ACTIVE = 'payment/amazon_payment/amazon_login_in_popup';

    /**
     * Config location of active setting of Amazon_Payment login with amazon module.
     */
    const XML_PATH_AMAZON_LOGIN_ACTIVE = 'payment/amazon_payment/lwa_enabled';

    /**
     * {@inheritDoc}
     */
    public function getModuleName()
    {
        return 'Amazon_Login';
    }

    /**
     * {@inheritDoc}
     */
    public function isModuleInUse()
    {
        /**
         * Both config settings need to be active before the requirejs-config file is needed.
         */

        return ((bool) $this->scopeConfig->getValue(self::XML_PATH_AMAZON_PAYMENT_ACTIVE, ScopeInterface::SCOPE_STORE) &&
            (bool) $this->scopeConfig->getValue(self::XML_PATH_AMAZON_LOGIN_ACTIVE, ScopeInterface::SCOPE_STORE));
    }
}
