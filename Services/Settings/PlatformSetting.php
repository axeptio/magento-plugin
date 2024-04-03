<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services\Settings;

use Axeptio\Integration\Services\Configuration\WidgetMainConfiguration;

class PlatformSetting implements SettingInterface
{
    protected WidgetMainConfiguration $widgetMainConfigurationService;

    public function __construct(
        WidgetMainConfiguration $widgetMainConfigurationService
    ) {
        $this->widgetMainConfigurationService = $widgetMainConfigurationService;
    }

    public function isActivated(): bool
    {
        return true;
    }

    public function getKey(): string
    {
        return 'platform';
    }

    /**
     * @inheriDoc
     */
    public function getValue()
    {
        return $this->widgetMainConfigurationService->getPlatform();
    }
}
