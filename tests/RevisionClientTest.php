<?php

namespace WQA\Gitbook\Tests;

use Dotenv\Dotenv;
use WQA\Gitbook\GitbookClient;
use PHPUnit\Framework\TestCase;
use WQA\Gitbook\Models\Variant;
use WQA\Gitbook\RevisionClient;
use WQA\Gitbook\Models\Revision;

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
}
