<?php

declare(strict_types=1);

namespace Axeptio\Integration\Block;

use Axeptio\Integration\Services\ScriptRenderer;
use Axeptio\Integration\Services\WidgetCustomizationSettings;
use Axeptio\Integration\Services\WidgetMainSettings;
use Axeptio\Integration\Services\WidgetSendingDataSettings;
use Magento\Framework\View\Element\Template;

class Axeptio extends Template
{
    protected ScriptRenderer $scriptRendererService;
    protected WidgetMainSettings $widgetMainSettingsService;
    protected WidgetCustomizationSettings $widgetCustomizationSettingsService;
    protected WidgetSendingDataSettings $widgetSendingDataSettingsService;

    public function __construct(
        ScriptRenderer $scriptRendererService,
        WidgetMainSettings $widgetMainSettingsService,
        WidgetCustomizationSettings $widgetCustomizationSettingsService,
        WidgetSendingDataSettings $widgetSendingDataSettingsService,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->scriptRendererService = $scriptRendererService;
        $this->widgetMainSettingsService = $widgetMainSettingsService;
        $this->widgetCustomizationSettingsService = $widgetCustomizationSettingsService;
        $this->widgetSendingDataSettingsService = $widgetSendingDataSettingsService;
    }

    // phpcs:ignore Squiz.NamingConventions.ValidFunctionName.PublicUnderscore
    protected function _toHtml(): string
    {
        return $this->scriptRendererService->canRender() ? parent::_toHtml() : '';
    }

    public function getProjectID(): string
    {
        return $this->widgetMainSettingsService->getProjectID();
    }

    public function getCookiesVersion(): string
    {
        return $this->widgetMainSettingsService->getCookiesVersion();
    }

    public function canRenderCookiesVersionParam(): bool
    {
        return $this->widgetMainSettingsService->canRenderCookiesVersionParam();
    }

    public function getPlatform(): string
    {
        return $this->widgetMainSettingsService->getPlatform();
    }

    public function getWidgetTitle(): string
    {
        return $this->widgetCustomizationSettingsService->getWidgetTitle();
    }

    public function getWidgetSubTitle(): string
    {
        return $this->widgetCustomizationSettingsService->getWidgetSubTitle();
    }

    public function getWidgetDescription(): string
    {
        return $this->widgetCustomizationSettingsService->getWidgetDescription();
    }

    public function isSendingDataEnabled(): bool
    {
        return $this->widgetSendingDataSettingsService->isSendingDataEnabled();
    }

    public function getSettings(): string
    {
        $settings = [
            'clientId'  => $this->getProjectID(),
            'platform'  => $this->getPlatform(),
            'sendDatas' => $this->isSendingDataEnabled() ? '1' : ''
        ];

        if ($this->canRenderCookiesVersionParam()) {
            $settings['cookiesVersion'] = $this->getCookiesVersion();
        }

        return json_encode($settings);
    }
}
