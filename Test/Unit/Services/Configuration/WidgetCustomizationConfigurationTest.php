<?php

declare(strict_types=1);

namespace Axeptio\Integration\Test\Unit\Services\Configuration;

use Axeptio\Integration\Services\Configuration\WidgetCustomizationConfiguration;
use Magento\Framework\App\Config\ScopeConfigInterface;
use PHPUnit\Framework\TestCase;

class WidgetCustomizationConfigurationTest extends TestCase
{
    private WidgetCustomizationConfiguration $widgetCustomizationConfiguration;

    protected function setUp(): void
    {
        $scopeConfigMock = $this->createMock(ScopeConfigInterface::class);

        $this->widgetCustomizationConfiguration = new WidgetCustomizationConfiguration($scopeConfigMock);
    }

    public function testReturnTypeWidgetTitle(): void
    {
        $this->assertIsString($this->widgetCustomizationConfiguration->getWidgetTitle());
    }

    public function testReturnTypeWidgetSubTitle(): void
    {
        $this->assertIsString($this->widgetCustomizationConfiguration->getWidgetSubTitle());
    }

    public function testReturnTypeWidgetDescription(): void
    {
        $this->assertIsString($this->widgetCustomizationConfiguration->getWidgetDescription());
    }
}
