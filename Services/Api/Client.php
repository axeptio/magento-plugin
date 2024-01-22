<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services\Api;

use Axeptio\Integration\Exception\FailedRequestAxeptioApiException;
use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Psr\Log\LoggerInterface;

class Client
{
    protected ClientFactory $clientFactory;
    protected ResponseFactory $responseFactory;
    protected LoggerInterface $logger;
    protected string $baseUrlApi;

    public function __construct(
        ClientFactory $clientFactory,
        ResponseFactory $responseFactory,
        LoggerInterface $logger,
        string $baseUrlApi
    ) {
        $this->clientFactory = $clientFactory;
        $this->responseFactory = $responseFactory;
        $this->logger = $logger;
        $this->baseUrlApi = $baseUrlApi;
    }

    public function doRequest(
        string $uri,
        array $params = [],
        string $requestMethod = 'GET'
    ): Response {
        /** @var HttpClient $client */
        $client = $this->clientFactory->create(['config' => [
            'base_uri' => $this->baseUrlApi
        ]]);

        try {
            return $client->request($requestMethod, $uri, $params);
        } catch (Exception $e) {
            $this->logger->error('[Axeptio] Failed to fetch uri : ' . $e->getMessage());
            throw new FailedRequestAxeptioApiException($e->getMessage());
        }
    }

    public function getContents(
        string $uri,
        array $params = [],
        string $requestMethod = 'GET'
    ): string {
        return $this->doRequest($uri, $params, $requestMethod)->getBody()->getContents();
    }
}
