<?php

declare(strict_types=1);

namespace Axeptio\Integration\Controller\Adminhtml\Integration;

use Axeptio\Integration\Exception\EmptyAxeptioCookiesVersionException;
use Axeptio\Integration\Services\Fetcher\CookieVersion;
use Exception;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;

class FetchCookies implements ActionInterface
{
    public const CONTROLLER_PATH = 'axeptio_admin/integration/fetchCookies';
    public const PROJECT_ID_PARAM_NAME = 'project_id';

    protected RequestInterface $request;
    protected JsonFactory $resultJsonFactory;
    protected CookieVersion $cookieVersionService;

    public function __construct(
        RequestInterface $request,
        JsonFactory $resultJsonFactory,
        CookieVersion $cookieVersionService
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->request = $request;
        $this->cookieVersionService = $cookieVersionService;
    }

    public function execute(): Json
    {
        $result = [
            'success'        => false,
            'error'          => false,
            'result_type'    => '',
            'result_message' => ''
        ];
        $response = $this->resultJsonFactory->create();

        if (!$projectID = $this->request->getParam(self::PROJECT_ID_PARAM_NAME)) {
            $result['error'] = true;
            $result['result_type'] = 'no_project_id';

            return $response->setData($result);
        }

        try {
            $cookies = $this->cookieVersionService->execute($projectID);
        } catch (EmptyAxeptioCookiesVersionException $e) {
            $result['error'] = true;
            $result['result_type'] = 'no_cookie_version';

            return $response->setData($result);
        } catch (Exception $e) {
            $result['error'] = true;
            $result['result_type'] = 'general_error';
            $result['result_message'] = $e->getMessage();

            return $response->setData($result);
        }

        $result['success'] = true;
        $result['cookies'] = $cookies;
        $result['result_type'] = 'cookies_fetched';

        return $response->setData($result);
    }
}
