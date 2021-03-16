<?php

namespace WQA\Gitbook\Tests;

use Dotenv\Dotenv;
use WQA\Gitbook\Models\Page;
use WQA\Gitbook\SpaceClient;
use WQA\Gitbook\Models\Space;
use WQA\Gitbook\GitbookClient;
use PHPUnit\Framework\TestCase;
use WQA\Gitbook\Models\Content;

class SpaceClientTest extends TestCase
{
    const SPACE_UID = '-MUTwNPskpIxMRpmIoAA';

    protected $spaceClient;

    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $this->secretKey = $_ENV['GITBOOK_SECRET'];
        $this->spaceClient = (new GitbookClient($this->secretKey))->space(self::SPACE_UID);
    }

    public function test_can_make_space_client()
    {
        $this->assertInstanceOf(SpaceClient::class, $this->spaceClient);
    }

    public function test_can_get_space()
    {
        $this->assertInstanceOf(Space::class, $this->spaceClient->get());
    }

    public function test_can_get_space_content()
    {
        $this->assertInstanceOf(Content::class, $this->spaceClient->getContent());
    }

    public function test_can_get_space_content_for_variant()
    {
        $this->assertInstanceOf(Space::class, $this->spaceClient->forVariant('testing')->getContent());
    }

    public function test_can_get_page()
    {
        $this->assertInstanceOf(Page::class, $this->spaceClient->getPage('-MUTwR2e5f5G0xp0CnOs'));
    }
}
