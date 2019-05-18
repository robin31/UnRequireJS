<?php

namespace Robin31\UnRequireJS\Model\Klarna;

use Robin31\UnRequireJS\Model\AbstractUnloader;

class KpUnloader extends AbstractUnloader
{

    /**
     * Config location of enabled/disabled setting of Klarna_KP payment module.
     */
    const XML_PATH_KLARNA_KP_ACTIVE = 'payment/klarna_kp/active';

    /**
     * {@inheritDoc}
     */
    public function getModuleName()
    {
        return 'Klarna_Kp';
    }

    /**
     * {@inheritDoc}
     */
    public function isModuleInUse()
    {
        return (bool) $this->scopeConfig->getValue(self::XML_PATH_KLARNA_KP_ACTIVE);
    }
}
