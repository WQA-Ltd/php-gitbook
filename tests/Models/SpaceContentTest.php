<?php

namespace WQA\Gitbook\Tests\Models;

use WQA\Gitbook\Models\Space;
use PHPUnit\Framework\TestCase;

class SpaceContentTest extends TestCase
{
    public function test_can_create_space_content_from_api_response()
    {
        $fakeResponse = '{"uid":"-MUiTCJIz9LCDCVucWqL","parents":["-MUiPTpTO0Ebe3kySYdz"],"variants":[{"uid":"master","ref":"master","title":"1.0.0","page":{"uid":"-MUTwR2e5f5G0xp0CnOs","title":"Index","description":"","kind":"document","path":"master","pages":[{"uid":"-MUU8ofqfig3qG3-lTO4","title":"How to use an API","description":"","kind":"document","path":"how-to-use-an-api","pages":[{"uid":"-MUU9Q8zCPDR1wxoKcX5","title":"API 1","description":"","kind":"document","path":"api-1","pages":[]},{"uid":"-MUU9T5P9_zCEwZXArhL","title":"API 2","description":"","kind":"document","path":"api-2","pages":[]}]},{"uid":"-MUU9GSSeF1EvrmEZeKa","title":"A third page","description":"","kind":"document","path":"third-page","pages":[]}]}}],"assets":[{"uid":"-MUiOB1gugnM1TwFskDC","name":"frosty-ilze-LlvfEJXGnc4-unsplash.jpg","downloadURL":"https://gblobscdn.gitbook.com/assets%2F-MUTwNPskpIxMRpmIoAA%2F-MUhaSttg73_algkx_wu%2F-MUiOB1gugnM1TwFskDC%2Ffrosty-ilze-LlvfEJXGnc4-unsplash.jpg?alt=media&token=1dfb8379-f32c-4780-8941-a1f19e0076c2","contentType":"image/jpeg"}]}';
        $spaceContent = Space::createFromApi($fakeResponse);

        $this->assertEquals('-MUiTCJIz9LCDCVucWqL', $spaceContent->uid);
        $this->assertEquals(['-MUiPTpTO0Ebe3kySYdz'], $spaceContent->parents);

        $this->markTestIncomplete();
    }
}
