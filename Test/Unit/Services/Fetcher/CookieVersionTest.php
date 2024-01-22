<?php

declare(strict_types=1);

namespace Axeptio\Integration\Test\Unit\Services\Fetcher;

use Axeptio\Integration\Exception\EmptyAxeptioCookiesVersionException;
use Axeptio\Integration\Exception\EmptyProjectIdException;
use Axeptio\Integration\Services\Api\Client;
use Axeptio\Integration\Services\Fetcher\CookieVersion as CookieVersionFetcher;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class CookieVersionTest extends TestCase
{
    private const PROJECT_ID = 'project-id';

    protected LoggerInterface $logger;

    protected function setUp(): void
    {
        $this->logger = $this->createMock(LoggerInterface::class);
    }

    public function testExceptionIsThrownWhenEmptyProjectIdIsPassed(): void
    {
        $clientApi = $this->createMock(Client::class);
        $cookieVersionFetcher = new CookieVersionFetcher($this->logger, $clientApi);

        $this->expectException(EmptyProjectIdException::class);
        $cookieVersionFetcher->execute('');
    }

    public function testExecuteWithCookiesInResponse(): void
    {
        $clientApi = $this->createMock(Client::class);
        $clientApi->method('getContents')
            ->willReturn(file_get_contents(__DIR__ . '/samples/project-id-with-cookies.json'));
        $cookieVersionFetcher = new CookieVersionFetcher($this->logger, $clientApi);

        $result = $cookieVersionFetcher->execute(self::PROJECT_ID);
        $this->assertIsArray($result);
        $this->assertEquals([
            'test-en-EU'   => 'English Test Cookies 1',
            'test-en-EU-2' => 'English Test Cookies'
        ], $result);
    }

    public function testExecuteWithNoCookieInResponse(): void
    {
        $clientApi = $this->createMock(Client::class);
        $clientApi->method('getContents')
            ->willReturn(file_get_contents(__DIR__ . '/samples/project-id-no-cookie.json'));
        $cookieVersionFetcher = new CookieVersionFetcher($this->logger, $clientApi);

        $this->expectException(EmptyAxeptioCookiesVersionException::class);
        $cookieVersionFetcher->execute(self::PROJECT_ID);
    }
}
