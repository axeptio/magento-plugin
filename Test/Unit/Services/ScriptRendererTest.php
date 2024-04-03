<?php

declare(strict_types=1);

namespace Axeptio\Integration\Test\Unit\Services;

use Axeptio\Integration\Services\Configuration\WidgetMainConfiguration;
use Axeptio\Integration\Services\ScriptRenderer;
use PHPUnit\Framework\TestCase;

class ScriptRendererTest extends TestCase
{
    public function testCanRender(): void
    {
        $widgetConfigurationMock = $this->createMock(WidgetMainConfiguration::class);
        $widgetConfigurationMock->method('isEnabled')->willReturn(true);
        $widgetConfigurationMock->method('getProjectID')->willReturn('TEST-ID');

        $scriptRenderer = new ScriptRenderer($widgetConfigurationMock);

        $this->assertTrue($scriptRenderer->canRender());
    }

    public function testCanRenderWithoutBeingEnabled(): void
    {
        $widgetConfigurationMock = $this->createMock(WidgetMainConfiguration::class);
        $widgetConfigurationMock->method('isEnabled')->willReturn(false);
        $widgetConfigurationMock->method('getProjectID')->willReturn('TEST-ID');

        $scriptRenderer = new ScriptRenderer($widgetConfigurationMock);

        $this->assertFalse($scriptRenderer->canRender());
    }

    public function testCanRenderWithoutGettingProjectID(): void
    {
        $widgetConfigurationMock = $this->createMock(WidgetMainConfiguration::class);
        $widgetConfigurationMock->method('isEnabled')->willReturn(true);
        $widgetConfigurationMock->method('getProjectID')->willReturn('');

        $scriptRenderer = new ScriptRenderer($widgetConfigurationMock);

        $this->assertFalse($scriptRenderer->canRender());
    }
}
