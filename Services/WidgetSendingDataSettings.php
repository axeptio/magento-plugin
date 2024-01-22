<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class WidgetSendingDataSettings
{
    public const AXEPTIO_WIDGET_SENDING_DATA_ENABLED_XML_PATH = 'axeptio/integration/data_sending/enabled';

    protected ScopeConfigInterface $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isSendingDataEnabled(): bool
    {
        return (bool) $this->scopeConfig->isSetFlag(
            self::AXEPTIO_WIDGET_SENDING_DATA_ENABLED_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }
}
