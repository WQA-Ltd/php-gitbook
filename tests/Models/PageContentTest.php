<?php

namespace WQA\Gitbook\Tests\Models;

use WQA\Gitbook\Models\Page;
use PHPUnit\Framework\TestCase;
use WQA\Gitbook\Models\PageContent;

class PageContentTest extends TestCase
{
    public function test_can_create_page_content_from_api_response()
    {
        $fakeResponse = '{
            "uid": "1234",
            "title": "Index",
            "description": "This is the page description",
            "kind": "document",
            "path": "master",
            "pages": [
                {
                    "uid": "1234-1",
                    "title": "Sub page 1",
                    "description": "",
                    "kind": "document",
                    "path": "sub-page-1",
                    "pages": [
                        {
                            "uid": "1234-1-1",
                            "title": "Sub sub page",
                            "description": "",
                            "kind": "document",
                            "path": "sub-sub-page",
                            "pages": []
                        }
                    ]
                },
                {
                    "uid": "1234-2",
                    "title": "Sub page 2",
                    "description": "",
                    "kind": "document",
                    "path": "sub-page-2",
                    "pages": []
                }
            ],
            "document": {
                "format_version": 1,
                "document": {
                    "kind": "document",
                    "key": "0726cf3c28df4b0abaf92809924e015c",
                    "data": {
                        "schema_version": 6
                    },
                    "nodes": []
                }
            }
        }';
        $page = PageContent::createFromApi($fakeResponse);

        $this->assertEquals('1234', $page->uid);
        $this->assertEquals('Index', $page->title);
        $this->assertEquals('This is the page description', $page->description);
        $this->assertEquals('document', $page->kind);
        $this->assertEquals('master', $page->path);
        $this->assertIsArray($page->pages);
        $this->assertInstanceOf(Page::class, $page->pages[0]);
        $this->assertInstanceOf(Page::class, $page->pages[0]->pages[0]);
        $this->assertIsObject($page->document);
    }
}
