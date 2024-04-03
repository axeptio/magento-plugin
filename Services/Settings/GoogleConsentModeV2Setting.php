<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services\Settings;

use Axeptio\Integration\Services\Configuration\WidgetGoogleConsentModeV2Configuration;

class GoogleConsentModeV2Setting implements SettingInterface
{
    private const DENIED = 'denied';
    private const GRANTED = 'granted';

    protected WidgetGoogleConsentModeV2Configuration $widgetGoogleConsentModeV2ConfigurationService;

    public function __construct(
        WidgetGoogleConsentModeV2Configuration $widgetGoogleConsentModeV2ConfigurationService
    ) {
        $this->widgetGoogleConsentModeV2ConfigurationService = $widgetGoogleConsentModeV2ConfigurationService;
    }

    public function isActivated(): bool
    {
        return $this->widgetGoogleConsentModeV2ConfigurationService->isGoogleConsentModeV2Enabled();
    }

    public function getKey(): string
    {
        return 'googleConsentMode';
    }

    /**
     * @inheriDoc
     */
    public function getValue()
    {
        return [
            'default' => [
                'analytics_storage'  => $this->getAnalyticsStorageValue(),
                'ad_storage'         => $this->getAdStorageValue(),
                'ad_user_data'       => $this->getAdUserDataValue(),
                'ad_personalization' => $this->getAdPersonalizationValue(),
            ]
        ];
    }

    public function getAnalyticsStorageValue(): string
    {
        return $this->widgetGoogleConsentModeV2ConfigurationService->isGoogleConsentModeV2AnalyticsStorageEnabled() ?
            self::GRANTED :
            self::DENIED;
    }

    public function getAdStorageValue(): string
    {
        return $this->widgetGoogleConsentModeV2ConfigurationService->isGoogleConsentModeV2AdStorageEnabled() ?
            self::GRANTED :
            self::DENIED;
    }

    public function getAdUserDataValue(): string
    {
        return $this->widgetGoogleConsentModeV2ConfigurationService->isGoogleConsentModeV2AdUserDataEnabled() ?
            self::GRANTED :
            self::DENIED;
    }

    public function getAdPersonalizationValue(): string
    {
        return $this->widgetGoogleConsentModeV2ConfigurationService->isGoogleConsentModeV2AdPersonalizationEnabled() ?
            self::GRANTED :
            self::DENIED;
    }
}
