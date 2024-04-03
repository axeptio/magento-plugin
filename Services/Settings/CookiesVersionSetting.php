<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services\Settings;

use Axeptio\Integration\Services\Configuration\WidgetMainConfiguration;

class CookiesVersionSetting implements SettingInterface
{
    protected WidgetMainConfiguration $widgetMainConfigurationService;

    public function __construct(
        WidgetMainConfiguration $widgetMainConfigurationService
    ) {
        $this->widgetMainConfigurationService = $widgetMainConfigurationService;
    }

    public function isActivated(): bool
    {
        return $this->widgetMainConfigurationService->canRenderCookiesVersionParam();
    }

    public function getKey(): string
    {
        return 'cookiesVersion';
    }

    /**
     * @inheriDoc
     */
    public function getValue()
    {
        return $this->widgetMainConfigurationService->getCookiesVersion();
    }
}
