<?php

declare(strict_types=1);

namespace Axeptio\Integration\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class GoogleConsentModeInformation extends Field
{
    public const GOOGLE_CONSENT_INFO_TEMPLATE =
        'Axeptio_Integration::system/config/google_consent_mode_information.phtml';

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
        return self::GOOGLE_CONSENT_INFO_TEMPLATE;
    }
}
