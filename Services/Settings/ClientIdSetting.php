<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services\Settings;

use Axeptio\Integration\Services\Configuration\WidgetMainConfiguration;

class ClientIdSetting implements SettingInterface
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
        return 'clientId';
    }

    /**
     * @inheriDoc
     */
    public function getValue()
    {
        return $this->widgetMainConfigurationService->getProjectID();
    }
}
