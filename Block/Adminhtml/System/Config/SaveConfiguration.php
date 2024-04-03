<?php

declare(strict_types=1);

namespace Axeptio\Integration\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class SaveConfiguration extends Field
{
    public const SAVE_CONFIGURATION_TEMPLATE = 'Axeptio_Integration::system/config/save_configuration.phtml';

    // phpcs:ignore Squiz.NamingConventions.ValidFunctionName.PublicUnderscore
    protected function _prepareLayout(): self
    {
        parent::_prepareLayout();
        $this->setTemplate($this->getTemplateFilename());

        return $this;
    }

    /**
     * @suppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function render(AbstractElement $element): string
    {
        return $this->_toHtml();
    }

    public function getTemplateFilename(): string
    {
        return self::SAVE_CONFIGURATION_TEMPLATE;
    }
}
