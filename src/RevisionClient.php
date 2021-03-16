<?php

namespace WQA\Gitbook;

use GuzzleHttp\Client;
use WQA\Gitbook\Models\Variant;
use WQA\Gitbook\Models\Revision;

class RevisionClient
{
    protected $client;
    protected $spaceUid;
    protected $revisionUid;
    protected $isDraft = false;

    public function __construct(Client $client, string $spaceUid, ?string $revisionUid)
    {
        $this->client = $client;
        $this->spaceUid = $spaceUid;
        $this->revisionUid = $revisionUid;
    }

    public function asDraft(): self
    {
        $this->isDraft = true;

        return $this;
    }

    public function get(): ?Revision
    {
        $response = $this->client->request('GET', $this->generateApiUri());

        if ($response->getStatusCode() === 200) {
            return Revision::createFromApi($response->getBody());
        }

        return null;
    }

    public function getVariant(string $variantUid = 'master'): ?Variant
    {
        $response = $this->client->request('GET', $this->generateApiUri("/v/{$variantUid}"));

        if ($response->getStatusCode() === 200) {
            return Variant::createFromApi($response->getBody());
        }

        return null;
    }

    protected function generateApiUri($append = ''): string
    {
        $uri = "spaces/{$this->spaceUid}/content";

        if ($this->revisionUid) {
            $revisionType = $this->isDraft ? 'drafts' : 'revisions';
            $uri = "spaces/{$this->spaceUid}/{$revisionType}/{$this->revisionUid}/content";
        }

        return $uri . $append;
    }
}
