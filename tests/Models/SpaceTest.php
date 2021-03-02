<?php

namespace WQA\Gitbook\Tests\Models;

use WQA\Gitbook\Models\Space;
use PHPUnit\Framework\TestCase;

class SpaceTest extends TestCase
{
    public function test_can_create_space_from_api_response()
    {
        $fakeResponse = '{"uid":"-MUTwNPskpIxMRpmIoAA","name":"KB","baseName":"kb","private":false,"unlisted":true}';
        $space = Space::createFromApi($fakeResponse);

        $this->assertEquals('-MUTwNPskpIxMRpmIoAA', $space->uid);
        $this->assertEquals('KB', $space->name);
        $this->assertEquals('kb', $space->baseName);
        $this->assertEquals(false, $space->private);
        $this->assertEquals(true, $space->unlisted);
    }
}
