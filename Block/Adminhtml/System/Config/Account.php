<?php

declare(strict_types=1);

namespace Axeptio\Integration\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Account extends Field
{
    public const ACCOUNT_TEMPLATE = 'Axeptio_Integration::system/config/account.phtml';
    public const AXEPTIO_SIGN_UP_URL = 'https://admin.axeptio.eu/#signup';
    public const AXEPTIO_LEARN_MORE_URL = 'https://www.axeptio.eu/fr/cookie-widget';
    public const AXEPTIO_LOGIN_URL = 'https://admin.axeptio.eu/';

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
        return self::ACCOUNT_TEMPLATE;
    }

    public function getSignUpUrl(): string
    {
        return self::AXEPTIO_SIGN_UP_URL;
    }

    public function getLearnMoreUrl(): string
    {
        return self::AXEPTIO_LEARN_MORE_URL;
    }

    public function getLoginUrl(): string
    {
        return self::AXEPTIO_LOGIN_URL;
    }
}
