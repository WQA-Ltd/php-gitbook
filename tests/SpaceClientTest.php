<?php

namespace WQA\Gitbook\Tests;

use Dotenv\Dotenv;
use WQA\Gitbook\SpaceClient;
use WQA\Gitbook\Models\Space;
use WQA\Gitbook\GitbookClient;
use PHPUnit\Framework\TestCase;
use WQA\Gitbook\RevisionClient;

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

    public function test_can_get_revision_client()
    {
        $this->assertInstanceOf(RevisionClient::class, $this->spaceClient->primaryRevision());
        $this->assertInstanceOf(RevisionClient::class, $this->spaceClient->revision('dummy-revision-uid'));
    }

    public function test_can_get_revision_client_for_a_draft()
    {
        $this->assertInstanceOf(RevisionClient::class, $this->spaceClient->draft('dummy-draft-uid'));
    }
}
