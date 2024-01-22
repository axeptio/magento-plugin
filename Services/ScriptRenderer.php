<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services;

class ScriptRenderer
{
    protected WidgetMainSettings $widgetMainSettingsService;

    public function __construct(
        WidgetMainSettings $widgetMainSettingsService
    ) {
        $this->widgetMainSettingsService = $widgetMainSettingsService;
    }

    public function canRender(): bool
    {
        return $this->widgetMainSettingsService->isEnabled()
            && !empty($this->widgetMainSettingsService->getProjectID());
    }
}
