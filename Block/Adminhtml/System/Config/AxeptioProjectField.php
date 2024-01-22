<?php

declare(strict_types=1);

namespace Axeptio\Integration\Block\Adminhtml\System\Config;

use Axeptio\Integration\Controller\Adminhtml\Integration\FetchCookies as FetchCookiesController;
use Axeptio\Integration\Services\WidgetMainSettings;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

abstract class AxeptioProjectField extends Field
{
    // phpcs:ignore Squiz.NamingConventions.ValidFunctionName.PublicUnderscore
    protected function _prepareLayout(): self
    {
        parent::_prepareLayout();
        $this->setTemplate($this->getTemplateFilename());

        return $this;
    }

    // phpcs:ignore Squiz.NamingConventions.ValidFunctionName.PublicUnderscore
    protected function _getElementHtml(AbstractElement $element): string
    {
        $this->addData($this->getTemplateData($element));

        return $this->_toHtml();
    }

    public function getFieldMappingData(): array
    {
        return [FetchCookiesController::PROJECT_ID_PARAM_NAME => 'axeptio_integration_main_settings_project_id'];
    }

    public function getFetchCookiesUrl(): string
    {
        return $this->_urlBuilder->getUrl(FetchCookiesController::CONTROLLER_PATH);
    }

    public function getTemplateData(AbstractElement $element): array
    {
        $originalData = $element->getOriginalData();

        return [
            'button_label'           => __($originalData['button_label'] ?? ''),
            'html_id'                => $element->getHtmlId(),
            'ajax_url'               => $this->getFetchCookiesUrl(),
            'field_mapping'          => str_replace('"', '\\"', json_encode($this->getFieldMappingData())),
            'default_cookie_version' => $this->getDefaultCookieVersion(),
            'is_inherit'             => $element->getInherit(),
            'is_global'              => !$this->_isInheritCheckboxRequired($element),
            'saved_value'            => $element->getValue(),
            'element_name'           => $element->getName()
        ];
    }

    public function getDefaultCookieVersion(): string
    {
        return WidgetMainSettings::DEFAULT_COOKIE_VERSION;
    }

    abstract public function getTemplateFilename(): string;
}
