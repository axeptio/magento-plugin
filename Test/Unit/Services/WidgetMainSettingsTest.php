<?php

declare(strict_types=1);

namespace Axeptio\Integration\Test\Unit\Services;

use Axeptio\Integration\Services\WidgetMainSettings;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class WidgetMainSettingsTest extends TestCase
{
    public function testIsEnabled(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'isSetFlag',
            WidgetMainSettings::AXEPTIO_ENABLED_XML_PATH,
            true
        );
        $widgetMainSettings = new WidgetMainSettings($scopeConfigMock);

        $result = $widgetMainSettings->isEnabled();
        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testIsDisabled(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'isSetFlag',
            WidgetMainSettings::AXEPTIO_ENABLED_XML_PATH,
            false
        );
        $widgetMainSettings = new WidgetMainSettings($scopeConfigMock);

        $result = $widgetMainSettings->isEnabled();
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function testReturnTypeProjectID(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'getValue',
            WidgetMainSettings::AXEPTIO_PROJECT_ID_XML_PATH,
            'test-ID'
        );
        $widgetMainSettings = new WidgetMainSettings($scopeConfigMock);

        $result = $widgetMainSettings->getProjectID();
        $this->assertIsString($result);
        $this->assertEquals('test-ID', $result);
    }

    public function testReturnTypeCookiesVersion(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'getValue',
            WidgetMainSettings::AXEPTIO_COOKIES_VERSION_XML_PATH,
            'cookie-version'
        );
        $widgetMainSettings = new WidgetMainSettings($scopeConfigMock);

        $result = $widgetMainSettings->getCookiesVersion();
        $this->assertIsString($result);
        $this->assertEquals('cookie-version', $result);
    }

    public function testReturnTypePlatform(): void
    {
        $widgetMainSettings = new WidgetMainSettings($this->createScopeConfigMock());
        $this->assertIsString($widgetMainSettings->getPlatform());
    }

    public function testCanRenderCookiesVersionParam(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'getValue',
            WidgetMainSettings::AXEPTIO_COOKIES_VERSION_XML_PATH,
            'cookie-version'
        );
        $widgetMainSettings = new WidgetMainSettings($scopeConfigMock);

        $this->assertTrue($widgetMainSettings->canRenderCookiesVersionParam());
    }

    public function testCanRenderCookiesVersionParamIfCookieVersionIsEmpty(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock(
            'getValue',
            WidgetMainSettings::AXEPTIO_COOKIES_VERSION_XML_PATH,
            ''
        );
        $widgetMainSettings = new WidgetMainSettings($scopeConfigMock);

        $this->assertFalse($widgetMainSettings->canRenderCookiesVersionParam());
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
