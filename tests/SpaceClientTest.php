<?php

namespace WQA\Gitbook\Tests;

use Dotenv\Dotenv;
use WQA\Gitbook\SpaceClient;
use WQA\Gitbook\Models\Space;
use WQA\Gitbook\GitbookClient;
use PHPUnit\Framework\TestCase;
use WQA\Gitbook\Models\SpaceContent;

class SpaceClientTest extends TestCase
{
    const SPACE_UID = '-MUTwNPskpIxMRpmIoAA';

    protected $client;

    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $this->secretKey = $_ENV['GITBOOK_SECRET'];
        $this->client = (new GitbookClient($this->secretKey))->space(self::SPACE_UID);
    }

    public function test_can_make_space_client()
    {
        $this->assertInstanceOf(SpaceClient::class, $this->client);
    }

    public function test_can_get_space_details()
    {
        $this->assertInstanceOf(Space::class, $this->client->getDetails());
    }

    public function test_can_get_space_content()
    {
        $this->assertInstanceOf(SpaceContent::class, $this->client->getContent());
    }
}
