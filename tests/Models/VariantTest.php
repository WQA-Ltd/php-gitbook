<?php

namespace WQA\Gitbook\Tests\Models;

use WQA\Gitbook\Models\Page;
use PHPUnit\Framework\TestCase;
use WQA\Gitbook\Models\Variant;

class VariantTest extends TestCase
{
    public function test_can_create_variant_from_api_response()
    {
        $fakeResponse = '{
            "uid": "master",
            "ref": "master",
            "title": "1.0.0",
            "page": {
                "uid": "-MUTwR2e5f5G0xp0CnOs",
                "title": "Index",
                "description": "",
                "kind": "document",
                "path": "master",
                "pages": [
                    {
                        "uid": "-MUU8ofqfig3qG3-lTO4",
                        "title": "How to use an API",
                        "description": "",
                        "kind": "document",
                        "path": "how-to-use-an-api",
                        "pages": [
                            {
                                "uid": "-MUU9Q8zCPDR1wxoKcX5",
                                "title": "API 1",
                                "description": "",
                                "kind": "document",
                                "path": "api-1",
                                "pages": []
                            },
                            {
                                "uid": "-MUU9T5P9_zCEwZXArhL",
                                "title": "API 2",
                                "description": "",
                                "kind": "document",
                                "path": "api-2",
                                "pages": []
                            }
                        ]
                    },
                    {
                        "uid": "-MUU9GSSeF1EvrmEZeKa",
                        "title": "A third page",
                        "description": "",
                        "kind": "document",
                        "path": "third-page",
                        "pages": []
                    }
                ]
            }
        }';
        $variant = Variant::createFromApi($fakeResponse);

        $this->assertEquals('master', $variant->uid);
        $this->assertEquals('master', $variant->ref);
        $this->assertEquals('1.0.0', $variant->title);
        $this->assertInstanceOf(Page::class, $variant->page);
    }
}
