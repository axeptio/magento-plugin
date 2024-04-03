<?php

declare(strict_types=1);

namespace Axeptio\Integration\Test\Unit\Services\Configuration;

use Axeptio\Integration\Services\Configuration\WidgetMainConfiguration;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class WidgetMainConfigurationTest extends TestCase
{
    public function testIsEnabled(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'isSetFlag',
            WidgetMainConfiguration::AXEPTIO_ENABLED_XML_PATH,
            true
        );
        $widgetMainConfiguration = new WidgetMainConfiguration($scopeConfigMock);

        $result = $widgetMainConfiguration->isEnabled();
        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testIsDisabled(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'isSetFlag',
            WidgetMainConfiguration::AXEPTIO_ENABLED_XML_PATH,
            false
        );
        $widgetMainConfiguration = new WidgetMainConfiguration($scopeConfigMock);

        $result = $widgetMainConfiguration->isEnabled();
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function testReturnTypeProjectID(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'getValue',
            WidgetMainConfiguration::AXEPTIO_PROJECT_ID_XML_PATH,
            'test-ID'
        );
        $widgetMainConfiguration = new WidgetMainConfiguration($scopeConfigMock);

        $result = $widgetMainConfiguration->getProjectID();
        $this->assertIsString($result);
        $this->assertEquals('test-ID', $result);
    }

    public function testReturnTypeCookiesVersion(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'getValue',
            WidgetMainConfiguration::AXEPTIO_COOKIES_VERSION_XML_PATH,
            'cookie-version'
        );
        $widgetMainConfiguration = new WidgetMainConfiguration($scopeConfigMock);

        $result = $widgetMainConfiguration->getCookiesVersion();
        $this->assertIsString($result);
        $this->assertEquals('cookie-version', $result);
    }

    public function testReturnTypePlatform(): void
    {
        $widgetMainConfiguration = new WidgetMainConfiguration($this->createScopeConfigMock());
        $this->assertIsString($widgetMainConfiguration->getPlatform());
    }

    public function testCanRenderCookiesVersionParam(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'getValue',
            WidgetMainConfiguration::AXEPTIO_COOKIES_VERSION_XML_PATH,
            'cookie-version'
        );
        $widgetMainConfiguration = new WidgetMainConfiguration($scopeConfigMock);

        $this->assertTrue($widgetMainConfiguration->canRenderCookiesVersionParam());
    }

    public function testCanRenderCookiesVersionParamIfCookieVersionIsEmpty(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'getValue',
            WidgetMainConfiguration::AXEPTIO_COOKIES_VERSION_XML_PATH,
            ''
        );
        $widgetMainConfiguration = new WidgetMainConfiguration($scopeConfigMock);

        $this->assertFalse($widgetMainConfiguration->canRenderCookiesVersionParam());
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
