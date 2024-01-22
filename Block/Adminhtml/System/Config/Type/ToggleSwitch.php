<?php

declare(strict_types=1);

namespace Axeptio\Integration\Block\Adminhtml\System\Config\Type;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Math\Random;
use Magento\Framework\View\Helper\SecureHtmlRenderer;

class ToggleSwitch extends Field
{
    public const SWITCHER_TEMPLATE = 'Axeptio_Integration::system/config/toggle_switch.phtml';

    protected SecureHtmlRenderer $secureRenderer;
    protected Random $random;

    public function __construct(
        SecureHtmlRenderer $secureRenderer,
        Random $random,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data, $secureRenderer);
        $this->secureRenderer = $secureRenderer;
        $this->random = $random;
    }

    // phpcs:ignore Squiz.NamingConventions.ValidFunctionName.PublicUnderscore
    protected function _prepareLayout(): self
    {
        parent::_prepareLayout();
        $this->setTemplate(self::SWITCHER_TEMPLATE);

        return $this;
    }

    // phpcs:ignore Squiz.NamingConventions.ValidFunctionName.PublicUnderscore
    protected function _getElementHtml(AbstractElement $element): string
    {
        $this->setData($this->getTemplateData($element));

        return $this->_toHtml();
    }

    public function getTemplateData(AbstractElement $element): array
    {
        $originalData = $element->getOriginalData();
        $labels = explode('|', $originalData['button_label'] ?? '');
        $switchOnLabel = $labels[0] ?? '';
        $switchOffLabel = $labels[1] ?? $switchOnLabel;

        return [
            'value'            => (bool) $element->getValue(),
            'id'               => $element->getHtmlId(),
            'name'             => $element->getName(),
            'switch_on_label'  => $switchOnLabel,
            'switch_off_label' => $switchOffLabel,
            'random_string'    => $this->getRandomString(),
            'is_inherit'       => $element->getInherit(),
            'is_global'        => $this->checkIfElementIsGlobal($element)
        ];
    }

    protected function checkIfElementIsGlobal(AbstractElement $element): bool
    {
        return !$this->_isInheritCheckboxRequired($element);
    }

    public function getRandomString(): string
    {
        try {
            return $this->random->getRandomString(10);
        } catch (LocalizedException $e) {
            return uniqid();
        }
    }
}
