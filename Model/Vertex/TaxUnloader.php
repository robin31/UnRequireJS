<?php

namespace Robin31\UnRequireJS\Model\Vertex;

use Magento\Store\Model\ScopeInterface;
use Robin31\UnRequireJS\Model\AbstractUnloader;

class TaxUnloader extends AbstractUnloader
{

    /**
     * Config location of active setting of Vertex_Tax module.
     */
    const XML_PATH_VERTEX_TAX_ACTIVE = 'tax/vertex_settings/enable_vertex';


    /**
     * {@inheritDoc}
     */
    public function getModuleName()
    {
        return 'Vertex_Tax';
    }

    /**
     * {@inheritDoc}
     */
    public function isModuleInUse()
    {
        /**
         * Both config settings need to be active before the requirejs-config file is needed.
         */

        return (bool) $this->scopeConfig->getValue(self::XML_PATH_VERTEX_TAX_ACTIVE, ScopeInterface::SCOPE_STORE);
    }
}
