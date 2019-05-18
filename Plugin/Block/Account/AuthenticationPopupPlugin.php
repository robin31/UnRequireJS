<?php

namespace Robin31\UnRequireJS\Plugin\Block\Account;

use Magento\Customer\Block\Account\AuthenticationPopup;
use Magento\Framework\Serialize\Serializer\Json;
use Robin31\UnRequireJS\Model\Amazon\LoginUnloader;
use Robin31\UnRequireJS\Model\MSP\ReCaptchaUnloader;

class AuthenticationPopupPlugin
{
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $json;
    /**
     * @var \Robin31\UnRequireJS\Model\MSP\ReCaptchaUnloader
     */
    protected $reCaptchaUnloader;
    /**
     * @var \Robin31\UnRequireJS\Model\Amazon\LoginUnloader
     */
    protected $loginUnloader;

    /**
     * AuthenticationPopupPlugin constructor.
     *
     * @param \Magento\Framework\Serialize\Serializer\Json     $json
     * @param \Robin31\UnRequireJS\Model\MSP\ReCaptchaUnloader $reCaptchaUnloader
     * @param \Robin31\UnRequireJS\Model\Amazon\LoginUnloader  $loginUnloader
     */
    public function __construct(
        Json $json,
        ReCaptchaUnloader $reCaptchaUnloader,
        LoginUnloader $loginUnloader
    ) {
        $this->json = $json;
        $this->reCaptchaUnloader = $reCaptchaUnloader;
        $this->loginUnloader = $loginUnloader;
    }

    /**
     * Plugin to remove unneed x-magento-init configuration if MSP or Amazon Login is not in use.
     * If this configuration is kept and the requirejs-config is unloaded this will give JS errors.
     *
     * @param \Magento\Customer\Block\Account\AuthenticationPopup $subject
     * @param                                                     $result
     *
     * @return string
     */
    public function afterGetJsLayout(AuthenticationPopup $subject, $result)
    {
        $layout = $this->json->unserialize($result);

        if ($this->reCaptchaUnloader->isModuleInUse() === false
            && isset($layout['components']['authenticationPopup']['children']['msp_recaptcha'])) {
            unset($layout['components']['authenticationPopup']['children']['msp_recaptcha']);
        }

        if ($this->loginUnloader->isModuleInUse() === false
            && isset($layout['components']['authenticationPopup']['children']['amazon-button'])) {
            unset($layout['components']['authenticationPopup']['children']['amazon-button']);
        }

        return $this->json->serialize($layout);
    }
}
