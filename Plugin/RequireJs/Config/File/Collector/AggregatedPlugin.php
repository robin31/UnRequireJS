<?php

namespace Robin31\UnRequireJS\Plugin\RequireJs\Config\File\Collector;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\RequireJs\Config;
use Magento\Framework\RequireJs\Config\File\Collector\Aggregated;
use Magento\Framework\View\Design\ThemeInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class AggregatedPlugin
 *
 * @package Robin31\UnRequireJS\Plugin\RequireJs\Config\File\Collector
 */
class AggregatedPlugin
{

    /**
     * XML path to the enabled/disabled setting of this module
     */
    const XML_PATH_MODULE_ENABLED = 'dev/js/unload_unused_requirejs';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * AggregatedPlugin constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Plugin to unload requirejs-config files if they are not in use.
     *
     * @param \Magento\Framework\RequireJs\Config\File\Collector\Aggregated $subject
     * @param callable                                                      $proceed
     * @param \Magento\Framework\View\Design\ThemeInterface                 $theme
     * @param                                                               $filePath
     *
     * @return \Magento\Framework\View\File[]
     */
    public function aroundGetFiles(Aggregated $subject, callable $proceed, ThemeInterface $theme, $filePath)
    {
        $result = $proceed($theme, $filePath);

        if ($filePath === Config::CONFIG_FILE_NAME && $this->isModuleEnabled()) {
            // @TODO: implement logic
        }

        return $result;
    }

    /**
     * Check if this module is enabled
     *
     * @return mixed
     */
    protected function isModuleEnabled()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_MODULE_ENABLED, ScopeInterface::SCOPE_STORE);
    }
}
