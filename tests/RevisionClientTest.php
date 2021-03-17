<?php

namespace WQA\Gitbook\Tests;

use Dotenv\Dotenv;
use WQA\Gitbook\Models\Page;
use InvalidArgumentException;
use WQA\Gitbook\GitbookClient;
use PHPUnit\Framework\TestCase;
use WQA\Gitbook\Models\Variant;
use WQA\Gitbook\RevisionClient;
use WQA\Gitbook\Models\Revision;
use WQA\Gitbook\Enums\PageFormat;

class RevisionClientTest extends TestCase
{
    const SPACE_UID = '-MUTwNPskpIxMRpmIoAA';

    protected $revisionClient;

    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $this->secretKey = $_ENV['GITBOOK_SECRET'];
        $this->revisionClient = (new GitbookClient($this->secretKey))->space(self::SPACE_UID)->primaryRevision();
    }

    public function test_can_make_revision_client()
    {
        $this->assertInstanceOf(RevisionClient::class, $this->revisionClient);
    }

    public function test_can_get_revision()
    {
        $this->assertInstanceOf(Revision::class, $this->revisionClient->get());
    }

    public function test_can_get_default_variant()
    {
        $this->assertInstanceOf(Variant::class, $this->revisionClient->getVariant());
    }

    public function test_can_get_specific_variant()
    {
        $this->assertInstanceOf(Variant::class, $this->revisionClient->getVariant('testing'));
    }

    public function test_can_get_page()
    {
        $this->assertInstanceOf(Page::class, $this->revisionClient->getPage('-MUTwR2e5f5G0xp0CnOs'));
    }

    public function test_can_get_page_for_variant()
    {
        $this->assertInstanceOf(Page::class, $this->revisionClient->getPage('-MUTwR2e5f5G0xp0CnOs', 'testing'));
    }

    public function test_can_get_page_as_markdown()
    {
        $this->assertInstanceOf(Page::class, $this->revisionClient->getPage('-MUTwR2e5f5G0xp0CnOs', 'testing', PageFormat::Markdown));
    }

    public function test_cannot_get_page_with_invalid_format()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->revisionClient->getPage('-MUTwR2e5f5G0xp0CnOs', 'testing', 'invalid_format');
    }

    public function test_can_get_page_by_url()
    {
        $this->assertInstanceOf(Page::class, $this->revisionClient->getPageByUrl('/how-to-use-an-api/api-2'));
    }
}
