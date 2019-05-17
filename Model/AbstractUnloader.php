<?php

namespace Robin31\UnRequireJS\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class AbstractUnloader
 *
 * @package Robin31\UnRequireJS\Model
 */
abstract class AbstractUnloader
{

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * AbstractUnloader constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get the name of the module that will be checked
     * @return string
     */
    abstract public function getModuleName();

    /**
     * Check if the module is in use
     * @return bool
     */
    abstract public function isModuleInUse();
}
