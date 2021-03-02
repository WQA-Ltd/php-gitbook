<?php

namespace WQA\Gitbook\Tests\Models;

use WQA\Gitbook\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_can_create_user_from_api_response()
    {
        $fakeResponse = '{"uid":"1234","kind":"user","title":"Lewis Hamilton","baseDomain":"some-domain"}';
        $user = User::createFromApi($fakeResponse);

        $this->assertEquals('1234', $user->uid);
        $this->assertEquals('user', $user->kind);
        $this->assertEquals('Lewis Hamilton', $user->title);
        $this->assertEquals('some-domain', $user->baseDomain);
    }
}
