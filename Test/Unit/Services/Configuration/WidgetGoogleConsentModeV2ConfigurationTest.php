<?php

declare(strict_types=1);

namespace Axeptio\Integration\Test\Unit\Services\Configuration;

use Axeptio\Integration\Services\Configuration\WidgetGoogleConsentModeV2Configuration;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class WidgetGoogleConsentModeV2ConfigurationTest extends TestCase
{
    private WidgetGoogleConsentModeV2Configuration $widgetGoogleConsentModeV2Configuration;

    public function testIsGoogleConsentModeV2Enabled(): void
    {
        $scopeConfigMock = $this->createScopeConfigMock('isSetFlag', WidgetGoogleConsentModeV2Configuration::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_ENABLED_XML_PATH, false);
        $widgetGoogleConsentModeV2Configuration = new WidgetGoogleConsentModeV2Configuration($scopeConfigMock);

        $result = $widgetGoogleConsentModeV2Configuration->isGoogleConsentModeV2Enabled();
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function testIsGoogleConsentModeV2AnalyticsStorageEnabled(): void
    {
        $scopeConfigMock = $this->createMock(ScopeConfigInterface::class);
        $scopeConfigMock->method('isSetFlag')->withConsecutive(
            [
                WidgetGoogleConsentModeV2Configuration::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            ],
            [
                WidgetGoogleConsentModeV2Configuration::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_ANALYTICS_STORAGE_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            ]
        )->willReturnOnConsecutiveCalls(true, false);

        $widgetGoogleConsentModeV2Configuration = new WidgetGoogleConsentModeV2Configuration($scopeConfigMock);

        $result = $widgetGoogleConsentModeV2Configuration->isGoogleConsentModeV2AnalyticsStorageEnabled();
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function testIsGoogleConsentModeV2AdStorageEnabled(): void
    {
        $scopeConfigMock = $this->createMock(ScopeConfigInterface::class);
        $scopeConfigMock->method('isSetFlag')->withConsecutive(
            [
                WidgetGoogleConsentModeV2Configuration::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            ],
            [
                WidgetGoogleConsentModeV2Configuration::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_AD_STORAGE_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            ]
        )->willReturnOnConsecutiveCalls(true, true);

        $widgetGoogleConsentModeV2Configuration = new WidgetGoogleConsentModeV2Configuration($scopeConfigMock);

        $result = $widgetGoogleConsentModeV2Configuration->isGoogleConsentModeV2AdStorageEnabled();
        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testIsGoogleConsentModeV2AdUserDataEnabled(): void
    {
        $scopeConfigMock = $this->createMock(ScopeConfigInterface::class);
        $scopeConfigMock->method('isSetFlag')->withConsecutive(
            [
                WidgetGoogleConsentModeV2Configuration::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            ],
            [
                WidgetGoogleConsentModeV2Configuration::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_AD_USER_DATA_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            ]
        )->willReturnOnConsecutiveCalls(false, true);

        $widgetGoogleConsentModeV2Configuration = new WidgetGoogleConsentModeV2Configuration($scopeConfigMock);

        $result = $widgetGoogleConsentModeV2Configuration->isGoogleConsentModeV2AdUserDataEnabled();
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function testIsGoogleConsentModeV2AdPersonalizationEnabled(): void
    {
        $scopeConfigMock = $this->createMock(ScopeConfigInterface::class);
        $scopeConfigMock->method('isSetFlag')->withConsecutive(
            [
                WidgetGoogleConsentModeV2Configuration::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            ],
            [
                WidgetGoogleConsentModeV2Configuration::AXEPTIO_WIDGET_GOOGLE_CONSENT_MODE_V2_AD_PERSONALIZATION_ENABLED_XML_PATH,
                ScopeInterface::SCOPE_STORE
            ]
        )->willReturnOnConsecutiveCalls(true, false);

        $widgetGoogleConsentModeV2Configuration = new WidgetGoogleConsentModeV2Configuration($scopeConfigMock);

        $result = $widgetGoogleConsentModeV2Configuration->isGoogleConsentModeV2AdPersonalizationEnabled();
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    private function createScopeConfigMock(
        string $methodName = '',
        string $path = '',
        mixed $value = null,
        ?MockObject $scopeConfigMock = null
    ): MockObject {
        if ($scopeConfigMock === null) {
            $scopeConfigMock = $this->createMock(ScopeConfigInterface::class);
        }

        if ($methodName && $path && $value !== null) {
            $scopeConfigMock->method($methodName)->with(
                $path,
                ScopeInterface::SCOPE_STORE
            )->willReturn($value);
        }

        return $scopeConfigMock;
    }
}
