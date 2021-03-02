<?php

namespace WQA\Gitbook;

use GuzzleHttp\Client;
use WQA\Gitbook\Models\Space;
use WQA\Gitbook\Models\SpaceContent;

class SpaceClient
{
    protected $client;
    protected $spaceUid;

    public function __construct(Client $client, string $spaceUid)
    {
        $this->client = $client;
        $this->spaceUid = $spaceUid;
    }

    public function getDetails(): ?Space
    {
        $response = $this->client->request('GET', 'spaces/' . $this->spaceUid);
        if ($response->getStatusCode() === 200) {
            return Space::createFromApi($response->getBody());
        }

        return null;
    }

    public function getContent(): ?SpaceContent
    {
        $response = $this->client->request('GET', 'spaces/' . $this->spaceUid . '/content');
        if ($response->getStatusCode() === 200) {
            return SpaceContent::createFromApi($response->getBody());
        }

        return null;
    }
}
