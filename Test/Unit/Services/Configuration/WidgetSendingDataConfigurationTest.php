<?php

declare(strict_types=1);

namespace Axeptio\Integration\Test\Unit\Services\Configuration;

use Axeptio\Integration\Services\Configuration\WidgetSendingDataConfiguration;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class WidgetSendingDataConfigurationTest extends TestCase
{
    private WidgetSendingDataConfiguration $widgetSendingDataConfiguration;

    public function testcanRenderCookiesVersionParam(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'isSetFlag',
            WidgetSendingDataConfiguration::AXEPTIO_WIDGET_SENDING_DATA_ENABLED_XML_PATH,
            true
        );
        $widgetSendingDataConfiguration = new WidgetSendingDataConfiguration($scopeConfigMock);

        $result = $widgetSendingDataConfiguration->isSendingDataEnabled();
        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testIsDisabled(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'isSetFlag',
            WidgetSendingDataConfiguration::AXEPTIO_WIDGET_SENDING_DATA_ENABLED_XML_PATH,
            false
        );
        $widgetSendingDataConfiguration = new WidgetSendingDataConfiguration($scopeConfigMock);

        $result = $widgetSendingDataConfiguration->isSendingDataEnabled();
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    private function createScopeConfigMock(string $methodName = '', string $path = '', mixed $value = null): MockObject
    {
        $scopeConfigMock = $this->createMock(ScopeConfigInterface::class);

        if ($methodName && $path && $value) {
            $scopeConfigMock->method($methodName)->with(
                $path,
                ScopeInterface::SCOPE_STORE
            )->willReturn($value);
        }

        return $scopeConfigMock;
    }
}
