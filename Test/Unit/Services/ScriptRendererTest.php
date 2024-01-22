<?php

declare(strict_types=1);

namespace Axeptio\Integration\Test\Unit\Services;

use Axeptio\Integration\Services\ScriptRenderer;
use Axeptio\Integration\Services\WidgetMainSettings;
use PHPUnit\Framework\TestCase;

class ScriptRendererTest extends TestCase
{
    public function testCanRender(): void
    {
        $widgetSettingsMock = $this->createMock(WidgetMainSettings::class);
        $widgetSettingsMock->method('isEnabled')->willReturn(true);
        $widgetSettingsMock->method('getProjectID')->willReturn('TEST-ID');

        $scriptRenderer = new ScriptRenderer($widgetSettingsMock);

        $this->assertTrue($scriptRenderer->canRender());
    }

    public function testCanRenderWithoutBeingEnabled(): void
    {
        $widgetSettingsMock = $this->createMock(WidgetMainSettings::class);
        $widgetSettingsMock->method('isEnabled')->willReturn(false);
        $widgetSettingsMock->method('getProjectID')->willReturn('TEST-ID');

        $scriptRenderer = new ScriptRenderer($widgetSettingsMock);

        $this->assertFalse($scriptRenderer->canRender());
    }

    public function testCanRenderWithoutGettingProjectID(): void
    {
        $widgetSettingsMock = $this->createMock(WidgetMainSettings::class);
        $widgetSettingsMock->method('isEnabled')->willReturn(true);
        $widgetSettingsMock->method('getProjectID')->willReturn('');

        $scriptRenderer = new ScriptRenderer($widgetSettingsMock);

        $this->assertFalse($scriptRenderer->canRender());
    }
}
