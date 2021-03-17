<?php

namespace WQA\Gitbook;

use GuzzleHttp\Client;
use WQA\Gitbook\Models\Space;

class SpaceClient
{
    protected $client;
    protected $spaceUid;

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
}
