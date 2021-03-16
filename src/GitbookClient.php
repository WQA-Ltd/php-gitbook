<?php

namespace WQA\Gitbook;

use GuzzleHttp\Client;
use WQA\Gitbook\Models\User;
use WQA\Gitbook\Models\Space;

class GitbookClient
{
    protected $secretKey;
    protected $client;

    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
        $this->client = $this->makeClient();
    }

    protected function makeClient(): Client
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->secretKey,
            'Accept' => 'application/json',
        ];

        return new Client([
            'base_uri' => 'https://api-beta.gitbook.com/v1/',
            'http_errors' => false,
            'headers' => $headers,
        ]);
    }

    public function getCurrentUser(): ?User
    {
        $response = $this->client->request('GET', 'user');

        if ($response->getStatusCode() === 200) {
            return User::createFromApi($response->getBody());
        }

        return null;
    }

    public function getUser(string $userUid): ?User
    {
        $response = $this->client->request('GET', 'owners/' . $userUid);

        if ($response->getStatusCode() === 200) {
            return User::createFromApi($response->getBody());
        }

        return null;
    }

    public function getSpaces(): array
    {
        $response = $this->client->request('GET', 'user/spaces');

        if ($response->getStatusCode() === 200) {
            return Space::createMultipleFromApi($response->getBody());
        }

        return null;
    }

    public function getSpacesFor(string $ownerId): array
    {
        $response = $this->client->request('GET', '/owners/' . $ownerId . '/spaces');

        if ($response->getStatusCode() === 200) {
            return Space::createMultipleFromApi($response->getBody());
        }

        return null;
    }

    public function space(string $spaceUid): SpaceClient
    {
        return new SpaceClient($this->client, $spaceUid);
    }
}
