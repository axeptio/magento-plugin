<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services\Configuration;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class WidgetGoogleConsentModeV2Configuration
{
    public const AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_ENABLED_XML_PATH =
        'axeptio/integration/google_consent_mode_v2/enabled';
    public const AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_ANALYTICS_STORAGE_ENABLED_XML_PATH =
        'axeptio/integration/google_consent_mode_v2/analytics_storage_enabled';
    public const AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_AD_STORAGE_ENABLED_XML_PATH =
        'axeptio/integration/google_consent_mode_v2/ad_storage_enabled';
    public const AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_AD_USER_DATA_ENABLED_XML_PATH =
        'axeptio/integration/google_consent_mode_v2/ad_user_data_enabled';
    public const AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_AD_PERSONALIZATION_ENABLED_XML_PATH =
        'axeptio/integration/google_consent_mode_v2/ad_personalization_enabled';

    protected ScopeConfigInterface $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isGoogleConsentModeV2Enabled(): bool
    {
        return (bool) $this->scopeConfig->isSetFlag(
            self::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_ENABLED_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function isGoogleConsentModeV2AnalyticsStorageEnabled(): bool
    {
        return $this->isGoogleConsentModeV2Enabled()
            && (bool) $this->scopeConfig->isSetFlag(
                self::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_ANALYTICS_STORAGE_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            );
    }

    public function isGoogleConsentModeV2AdStorageEnabled(): bool
    {
        return $this->isGoogleConsentModeV2Enabled()
            && (bool) $this->scopeConfig->isSetFlag(
                self::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_AD_STORAGE_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            );
    }

    public function isGoogleConsentModeV2AdUserDataEnabled(): bool
    {
        return $this->isGoogleConsentModeV2Enabled()
            && (bool) $this->scopeConfig->isSetFlag(
                self::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_AD_USER_DATA_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            );
    }

    public function isGoogleConsentModeV2AdPersonalizationEnabled(): bool
    {
        return $this->isGoogleConsentModeV2Enabled()
            && (bool) $this->scopeConfig->isSetFlag(
                self::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_AD_PERSONALIZATION_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            );
    }
}
