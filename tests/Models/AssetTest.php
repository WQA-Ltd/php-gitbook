<?php

namespace WQA\Gitbook\Tests\Models;

use WQA\Gitbook\Models\Asset;
use PHPUnit\Framework\TestCase;

class AssetTest extends TestCase
{
    public function test_can_create_asset_from_api_response()
    {
        $fakeResponse = '{
            "uid": "1234",
            "name": "gitbook.jpeg",
            "downloadURL": "https://example.com/gitbook.jpeg",
            "contentType": "image/jpeg"
        }';
        $asset = Asset::createFromApi($fakeResponse);

        $this->assertEquals('1234', $asset->uid);
        $this->assertEquals('gitbook.jpeg', $asset->name);
        $this->assertEquals('https://example.com/gitbook.jpeg', $asset->downloadURL);
        $this->assertEquals('image/jpeg', $asset->contentType);
    }
}
