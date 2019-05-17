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
     */
    protected $unloaderList;

    /**
     * AggregatedPlugin constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param array                                              $unloaderList
     */
    public function __construct(ScopeConfigInterface $scopeConfig, array $unloaderList)
    {
        $this->scopeConfig = $scopeConfig;
        $this->unloaderList = $unloaderList;
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
        $results = $proceed($theme, $filePath);

        if ($filePath === Config::CONFIG_FILE_NAME && $this->isModuleEnabled()) {
            foreach ($results as $key => $requireJSConfigFile) {
                /** @var \Magento\Framework\View\File $requireJSConfigFile */

                $unloaders = array_filter(
                    $this->unloaderList,
                    function ($o) use ($requireJSConfigFile) {
                        /** @var \Robin31\UnRequireJS\Model\AbstractUnloader $o */
                        return $o->getModuleName() === $requireJSConfigFile->getModule();
                    }
                );

                foreach ($unloaders as $unloader) {
                    if ($unloader->isModuleInUse() === false) {
                        unset($results[$key]);
                        break;
                    }
                }
            }
        }

        return $results;
    }

    /**
     * Check if this module is enabled
     *
     * @return bool
     */
    protected function isModuleEnabled()
    {
        return (bool) $this->scopeConfig->getValue(self::XML_PATH_MODULE_ENABLED, ScopeInterface::SCOPE_STORE);
    }
}
