<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services\Fetcher;

use Axeptio\Integration\Exception\EmptyAxeptioCookiesVersionException;
use Axeptio\Integration\Exception\EmptyProjectIdException;
use Axeptio\Integration\Exception\FailedRequestAxeptioApiException;
use Axeptio\Integration\Services\Api\Client;
use Psr\Log\LoggerInterface;

class CookieVersion
{
    protected LoggerInterface $logger;
    protected Client $clientApi;

    public function __construct(
        LoggerInterface $logger,
        Client $clientApi
    ) {
        $this->logger = $logger;
        $this->clientApi = $clientApi;
    }

    /**
     * @throws EmptyAxeptioCookiesVersionException
     * @throws FailedRequestAxeptioApiException
     * @throws EmptyProjectIdException
     */
    public function execute(string $projectID): array
    {
        if (empty($projectID)) {
            throw new EmptyProjectIdException(__('Project ID is required.')->render());
        }

        $result = $this->doRequest($projectID);

        $data = json_decode($result, true);
        $cookies = [];

        foreach ($data['cookies'] ?? [] as $cookie) {
            if (isset($cookie['name'], $cookie['title'])) {
                $cookies[$cookie['name']] = $cookie['title'];
            }
        }

        if (empty($cookies)) {
            throw new EmptyAxeptioCookiesVersionException();
        }

        return $cookies;
    }

    /**
     * @throws FailedRequestAxeptioApiException
     */
    public function doRequest(string $projectID): string
    {
        return $this->clientApi->getContents($this->getFilename($projectID));
    }

    public function getFilename(string $projectID): string
    {
        return sprintf('%s.json', $projectID);
    }
}
