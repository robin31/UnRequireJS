<?php

namespace Robin31\UnRequireJS\Plugin\Model;

use Klarna\Kp\Model\KpConfigProvider;
use Robin31\UnRequireJS\Model\Klarna\KpUnloader;

class KpConfigProviderPlugin
{
    /**
     * @var \Robin31\UnRequireJS\Model\Klarna\KpUnloader
     */
    protected $kpUnloader;

    /**
     * KpConfigProviderPlugin constructor.
     *
     * @param \Robin31\UnRequireJS\Model\Klarna\KpUnloader $kpUnloader
     */
    public function __construct(KpUnloader $kpUnloader)
    {
        $this->kpUnloader = $kpUnloader;
    }

    public function afterGetConfig(KpConfigProvider $subject, $result)
    {
        if ($this->kpUnloader->isModuleInUse() === false) {
            return [];
        }
        return $result;
    }
}
