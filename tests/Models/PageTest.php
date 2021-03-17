<?php

namespace WQA\Gitbook\Tests\Models;

use WQA\Gitbook\Models\Page;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    public function test_can_create_page_from_api_response()
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
            ]
        }';
        $page = Page::createFromApi($fakeResponse);

        $this->assertEquals('1234', $page->uid);
        $this->assertEquals('Index', $page->title);
        $this->assertEquals('This is the page description', $page->description);
        $this->assertEquals('document', $page->kind);
        $this->assertEquals('master', $page->path);
        $this->assertIsArray($page->pages);
        $this->assertInstanceOf(Page::class, $page->pages[0]);
        $this->assertInstanceOf(Page::class, $page->pages[0]->pages[0]);
    }
}
