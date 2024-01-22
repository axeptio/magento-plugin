<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class WidgetMainSettings
{
    public const DEFAULT_COOKIE_VERSION = 'default';
    public const PLATFORM = 'plugin-magento';
    public const AXEPTIO_ENABLED_XML_PATH = 'axeptio/integration/main_settings/enabled';
    public const AXEPTIO_PROJECT_ID_XML_PATH = 'axeptio/integration/main_settings/project_id';
    public const AXEPTIO_COOKIES_VERSION_XML_PATH = 'axeptio/integration/main_settings/cookie_version';

    protected ScopeConfigInterface $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled(): bool
    {
        return (bool) $this->scopeConfig->isSetFlag(
            self::AXEPTIO_ENABLED_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getProjectID(): string
    {
        return (string) $this->scopeConfig->getValue(
            self::AXEPTIO_PROJECT_ID_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getCookiesVersion(): string
    {
        return (string) $this->scopeConfig->getValue(
            self::AXEPTIO_COOKIES_VERSION_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function canRenderCookiesVersionParam(): bool
    {
        $cookieVersion = $this->getCookiesVersion();

        return !empty($cookieVersion)
            && $cookieVersion !== self::DEFAULT_COOKIE_VERSION;
    }

    public function getPlatform(): string
    {
        return self::PLATFORM;
    }
}
