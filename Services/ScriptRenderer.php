<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services;

use Axeptio\Integration\Services\Configuration\WidgetMainConfiguration;

class ScriptRenderer
{
    protected WidgetMainConfiguration $widgetMainConfigurationService;

    public function __construct(
        WidgetMainConfiguration $widgetMainConfigurationService
    ) {
        $this->widgetMainConfigurationService = $widgetMainConfigurationService;
    }

    public function canRender(): bool
    {
        return $this->widgetMainConfigurationService->isEnabled()
            && !empty($this->widgetMainConfigurationService->getProjectID());
    }
}
