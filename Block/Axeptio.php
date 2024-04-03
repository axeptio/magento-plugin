<?php

declare(strict_types=1);

namespace Axeptio\Integration\Block;

use Axeptio\Integration\Services\ScriptRenderer;
use Axeptio\Integration\Services\Settings\SettingInterface;
use Magento\Framework\View\Element\Template;

class Axeptio extends Template
{
    /**
     * @var SettingInterface[]
     */
    protected array $settings = [];

    protected ScriptRenderer $scriptRendererService;

    public function __construct(
        ScriptRenderer $scriptRendererService,
        Template\Context $context,
        array $settings,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->settings = $settings;
        $this->scriptRendererService = $scriptRendererService;
    }

    // phpcs:ignore Squiz.NamingConventions.ValidFunctionName.PublicUnderscore
    protected function _toHtml(): string
    {
        return $this->scriptRendererService->canRender() ? parent::_toHtml() : '';
    }

    public function getSettings(): string
    {
        $settings = [];
        foreach ($this->settings as $setting) {
            if ($setting->isActivated()) {
                $settings[$setting->getKey()] = $setting->getValue();
            }
        }

        return json_encode($settings);
    }
}
