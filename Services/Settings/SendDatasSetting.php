<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services\Settings;

use Axeptio\Integration\Services\Configuration\WidgetSendingDataConfiguration;

class SendDatasSetting implements SettingInterface
{
    protected WidgetSendingDataConfiguration $widgetSendingDataConfigurationService;

    public function __construct(
        WidgetSendingDataConfiguration $widgetSendingDataConfigurationService
    ) {
        $this->widgetSendingDataConfigurationService = $widgetSendingDataConfigurationService;
    }

    public function isActivated(): bool
    {
        return true;
    }

    public function getKey(): string
    {
        return 'sendDatas';
    }

    /**
     * @inheriDoc
     */
    public function getValue()
    {
        return $this->widgetSendingDataConfigurationService->isSendingDataEnabled() ? '1' : '';
    }
}
