<?php

namespace WQA\Gitbook;

use GuzzleHttp\Client;
use WQA\Gitbook\Models\Page;
use WQA\Gitbook\Models\Space;
use WQA\Gitbook\Models\Variant;
use WQA\Gitbook\Models\Revision;

class SpaceClient
{
    protected $client;
    protected $spaceUid;
    // protected $variantUid = 'master';
    // protected $revisionUid;
    // protected $draftUid;

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

    public function revision(?string $revisionUid): RevisionClient
    {
        return new RevisionClient($this->client, $this->spaceUid, $revisionUid);
    }

    public function primaryRevision(): RevisionClient
    {
        return $this->revision(null);
    }

    public function draft(?string $draftUid): RevisionClient
    {
        return (new RevisionClient($this->client, $this->spaceUid, $draftUid))->asDraft();
    }

    // public function getVariant(): ?Variant
    // {
    //     $response = $this->client->request('GET', $this->variantUri());
    //     if ($response->getStatusCode() === 200) {
    //         return Variant::createFromApi($response->getBody());
    //     }

    //     return null;
    // }

    // public function getPage($pageUid): ?Page
    // {
    //     $response = $this->client->request('GET', $this->variantUri("/id/{$pageUid}"));
    //     if ($response->getStatusCode() === 200) {
    //         return Page::createFromApi($response->getBody());
    //     }

    //     return null;
    // }

    // public function forVariant(string $variantUid): self
    // {
    //     $this->variantUid = $variantUid;

    //     return $this;
    // }

    // public function forDraft(string $draftUid): self
    // {
    //     $this->draftUid = $draftUid;

    //     return $this;
    // }

    // public function forRevision(string $revisionUid): self
    // {
    //     $this->revisionUid = $revisionUid;

    //     return $this;
    // }

    // protected function variantUri($append = '')
    // {
    //     $base = "spaces/{$this->spaceUid}";

    //     if ($this->draftUid) {
    //         $base . "/drafts/{$this->draftUid}";
    //     }

    //     if ($this->revisionUid) {
    //         $base . "/revisions/{$this->revisionUid}";
    //     }

    //     $uri = $base . "/content/v/{$this->variantUid}" . $append;

    //     return $uri;
    // }
}
