<?php

declare(strict_types=1);

namespace Axeptio\Integration\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\View\Helper\SecureHtmlRenderer;
use Magento\Store\Model\StoreManagerInterface;

class CookieVersion extends AxeptioProjectField
{
    public const COOKIE_VERSION_TEMPLATE = 'Axeptio_Integration::system/config/cookie_version.phtml';

    protected StoreManagerInterface $storeManager;

    public function __construct(
        Context $context,
        SecureHtmlRenderer $secureRenderer,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data, $secureRenderer);
        $this->storeManager = $storeManager;
    }

    public function getTemplateData(AbstractElement $element): array
    {
        return array_merge(parent::getTemplateData($element), [
            'scope_label'  => $this->getScopeLabel()
        ]);
    }

    public function getScopeLabel(): string
    {
        if ($storeId = $this->_request->getParam('store')) {
            return $this->storeManager->getStore($storeId)->getName();
        }

        if ($websiteId = $this->_request->getParam('website')) {
            return $this->storeManager->getWebsite($websiteId)->getName();
        }

        return __('Default')->render();
    }

    public function getTemplateFilename(): string
    {
        return self::COOKIE_VERSION_TEMPLATE;
    }
}
