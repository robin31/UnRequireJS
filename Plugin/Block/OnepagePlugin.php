<?php

namespace Robin31\UnRequireJS\Plugin\Block;

use Magento\Checkout\Block\Onepage;
use Magento\Framework\Serialize\Serializer\Json;
use Robin31\UnRequireJS\Model\Vertex\TaxUnloader;

class OnepagePlugin
{

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $json;
    /**
     * @var \Robin31\UnRequireJS\Model\Vertex\TaxUnloader
     */
    protected $taxUnloader;

    /**
     * TotalsPlugin constructor.
     *
     * @param \Magento\Framework\Serialize\Serializer\Json  $json
     * @param \Robin31\UnRequireJS\Model\Vertex\TaxUnloader $taxUnloader
     */
    public function __construct(Json $json, TaxUnloader $taxUnloader)
    {
        $this->json = $json;
        $this->taxUnloader = $taxUnloader;
    }

    /**
     * Plugin to remove unnecessary x-magento-init configuration in cart for Vertex_Tax
     * If this configuration is kept and the requirejs-config is unloaded this could give JS errors.
     *
     * @param \Magento\Checkout\Block\Onepage                     $subject
     * @param                                                     $result
     *
     * @return string
     */
    public function afterGetJsLayout(Onepage $subject, $result)
    {
        $layout = $this->json->unserialize($result);

        if ($this->taxUnloader->isModuleInUse() === false
            && isset($layout['components']['checkout']['children']['sidebar']['children']['summary']['children']['totals']['children']['vertex-messages'])) {
            unset($layout['components']['checkout']['children']['sidebar']['children']['summary']['children']['totals']['children']['vertex-messages']);
        }

        return $this->json->serialize($layout);
    }
}
