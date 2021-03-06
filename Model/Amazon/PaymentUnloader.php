<?php

namespace Robin31\UnRequireJS\Model\Amazon;

use Magento\Store\Model\ScopeInterface;
use Robin31\UnRequireJS\Model\AbstractUnloader;

class PaymentUnloader extends AbstractUnloader
{

    /**
     * Config location of active setting of Amazon_Payment payment method module.
     */
    const XML_PATH_AMAZON_PAYMENT_ACTIVE = 'payment/amazon_payment/active';

    /**
     * Config location of active setting of Amazon_Payment login with amazon module.
     * As it seems this can be enabled without having Pay with Amazon enabled both settings require the javascript to be present.
     */
    const XML_PATH_AMAZON_LOGIN_ACTIVE = 'payment/amazon_payment/lwa_enabled';

    /**
     * {@inheritDoc}
     */
    public function getModuleName()
    {
        return 'Amazon_Payment';
    }

    /**
     * {@inheritDoc}
     */
    public function isModuleInUse()
    {
        /**
         * If 1 of the 2 config settings is active the requirejs-config file is needed on frontend.
         */
        return ((bool) $this->scopeConfig->getValue(self::XML_PATH_AMAZON_PAYMENT_ACTIVE, ScopeInterface::SCOPE_STORE) ||
            (bool) $this->scopeConfig->getValue(self::XML_PATH_AMAZON_LOGIN_ACTIVE, ScopeInterface::SCOPE_STORE));
    }
}
