<?php

declare(strict_types=1);

namespace Axeptio\Integration\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class HowToIntegrate extends Field
{
    public const HOW_TO_INTEGRATE_TEMPLATE = 'Axeptio_Integration::system/config/how_to_integrate.phtml';
    public const YOUTUBE_VIDEO_URL = 'https://www.youtube.com/embed/59uKOsSfO54?si=H2QoGJCr7FbAGhRH';

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
        return self::HOW_TO_INTEGRATE_TEMPLATE;
    }

    public function getYoutubeVideoUrl(): string
    {
        return self::YOUTUBE_VIDEO_URL;
    }
}
