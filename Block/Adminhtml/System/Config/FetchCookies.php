<?php

declare(strict_types=1);

namespace Axeptio\Integration\Block\Adminhtml\System\Config;

class FetchCookies extends AxeptioProjectField
{
    public const FETCH_COOKIES_TEMPLATE = 'Axeptio_Integration::system/config/fetch_cookies.phtml';

    public function unScopeField(): bool
    {
        return true;
    }

    public function getTemplateFilename(): string
    {
        return self::FETCH_COOKIES_TEMPLATE;
    }
}
