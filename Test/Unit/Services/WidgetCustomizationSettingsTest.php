<?php

declare(strict_types=1);

namespace Axeptio\Integration\Test\Unit\Services;

use Axeptio\Integration\Services\WidgetCustomizationSettings;
use Magento\Framework\App\Config\ScopeConfigInterface;
use PHPUnit\Framework\TestCase;

class WidgetCustomizationSettingsTest extends TestCase
{
    private WidgetCustomizationSettings $widgetCustomizationSettings;

    protected function setUp(): void
    {
        $scopeConfigMock = $this->createMock(ScopeConfigInterface::class);

        $this->widgetCustomizationSettings = new WidgetCustomizationSettings($scopeConfigMock);
    }

    public function testReturnTypeWidgetTitle(): void
    {
        $this->assertIsString($this->widgetCustomizationSettings->getWidgetTitle());
    }

    public function testReturnTypeWidgetSubTitle(): void
    {
        $this->assertIsString($this->widgetCustomizationSettings->getWidgetSubTitle());
    }

    public function testReturnTypeWidgetDescription(): void
    {
        $this->assertIsString($this->widgetCustomizationSettings->getWidgetDescription());
    }
}
