<?php

declare(strict_types=1);

namespace Axeptio\Integration\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\View\Helper\SecureHtmlRenderer;

class ProjectID extends AxeptioProjectField
{
    public const PROJECT_ID_TEMPLATE = 'Axeptio_Integration::system/config/project_id.phtml';

    protected SecureHtmlRenderer $secureRenderer;

    public function __construct(
        Context $context,
        SecureHtmlRenderer $secureRenderer,
        array $data = []
    ) {
        parent::__construct($context, $data, $secureRenderer);
        $this->secureRenderer = $secureRenderer;
    }

    // phpcs:ignore Squiz.NamingConventions.ValidFunctionName.PublicUnderscore
    public function _renderValue(AbstractElement $element): string
    {
        $html = $element->getValue() ? $this->getScript($element) : '';
        $html .= parent::_renderValue($element);

        return $html;
    }

    public function getScript(AbstractElement $element): string
    {
        $script = <<<script
                window.addEventListener('check-project-id', () => {
                    if (document.getElementById("{$element->getHtmlId()}").value) {
                        window.dispatchEvent(new CustomEvent('project-id-already-configured', {}));
                    }
                });
            script;

        return $this->secureRenderer->renderTag('script', ['type' => 'text/javascript'], $script, false);
    }

    public function getTemplateFilename(): string
    {
        return self::PROJECT_ID_TEMPLATE;
    }
}
