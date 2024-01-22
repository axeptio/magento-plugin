<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class WidgetCustomizationSettings
{
    public const AXEPTIO_WIDGET_TITLE_XML_PATH = 'axeptio/integration/customization_settings/title';
    public const AXEPTIO_WIDGET_SUBTITLE_XML_PATH = 'axeptio/integration/customization_settings/subtitle';
    public const AXEPTIO_WIDGET_DESCRIPTION_XML_PATH = 'axeptio/integration/customization_settings/description';

    protected ScopeConfigInterface $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getWidgetTitle(): string
    {
        return (string) $this->scopeConfig->getValue(
            self::AXEPTIO_WIDGET_TITLE_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getWidgetSubTitle(): string
    {
        return (string) $this->scopeConfig->getValue(
            self::AXEPTIO_WIDGET_SUBTITLE_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getWidgetDescription(): string
    {
        return (string) $this->scopeConfig->getValue(
            self::AXEPTIO_WIDGET_DESCRIPTION_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }
}
