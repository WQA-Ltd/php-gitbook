<?php

namespace WQA\Gitbook;

use GuzzleHttp\Client;
use WQA\Gitbook\Models\Page;
use WQA\Gitbook\Models\Space;
use WQA\Gitbook\Models\Content;

class SpaceClient
{
    protected $client;
    protected $spaceUid;
    protected $variantUid = 'master';
    protected $revisionUid;
    protected $draftUid;

    public function __construct(Client $client, string $spaceUid)
    {
        $this->client = $client;
        $this->spaceUid = $spaceUid;
    }

    public function get(): ?Space
    {
        $response = $this->client->request('GET', "spaces/{$this->spaceUid}");
        if ($response->getStatusCode() === 200) {
            return Space::createFromApi($response->getBody());
        }

        return null;
    }

    public function getContent(): ?Content
    {
        $response = $this->client->request('GET', $this->contentUri());
        if ($response->getStatusCode() === 200) {
            return Content::createFromApi($response->getBody());
        }

        return null;
    }

    public function getPage($pageUid): ?Page
    {
        $response = $this->client->request('GET', $this->contentUri("/id/{$pageUid}"));
        if ($response->getStatusCode() === 200) {
            return Page::createFromApi($response->getBody());
        }

        return null;
    }

    public function forVariant(string $variantUid): self
    {
        $this->variantUid = $variantUid;

        return $this;
    }

    public function forDraft(string $draftUid): self
    {
        $this->draftUid = $draftUid;

        return $this;
    }

    public function forRevision(string $revisionUid): self
    {
        $this->revisionUid = $revisionUid;

        return $this;
    }

    protected function contentUri($append = '')
    {
        $base = "spaces/{$this->spaceUid}";

        if ($this->draftUid) {
            $base . "/drafts/{$this->draftUid}";
        }

        if ($this->revisionUid) {
            $base . "/revisions/{$this->revisionUid}";
        }

        return $base . "/content/v/{$this->variantUid}" . $append;
    }
}
