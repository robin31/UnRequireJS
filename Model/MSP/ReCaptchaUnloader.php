<?php

namespace Robin31\UnRequireJS\Model\MSP;

use Robin31\UnRequireJS\Model\AbstractUnloader;

class ReCaptchaUnloader extends AbstractUnloader
{

    /**
     * Config location of enabled/disabled setting of MSP_ReCaptcha module for Magento 2 frontend.
     *
     * Inside MSP\ReCaptcha\Model\Config the same path is declared. This path cannot be used because MSP_ReCaptcha module
     * could be disabled by config.php resulting in exceptions.
     */
    const XML_PATH_ENABLED_FRONTEND = 'msp_securitysuite_recaptcha/frontend/enabled';

    /**
     * {@inheritDoc}
     */
    public function getModuleName()
    {
        return 'MSP_ReCaptcha';
    }

    /**
     * {@inheritDoc}
     */
    public function isModuleInUse()
    {
        /**
         * The original `isEnabledFrontend` method of MSP_ReCaptha also check if public and private key are in use.
         * This check is not included. Enabling the module through admin will get the requirejs-config back.
         */
        return (bool) $this->scopeConfig->getValue(self::XML_PATH_ENABLED_FRONTEND);
    }
}
