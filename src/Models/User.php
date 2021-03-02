<?php

namespace WQA\Gitbook\Models;

class User extends Model
{
    /** @var string */
    public $uid;

    /** @var string */
    public $kind;

    /** @var string */
    public $title;

    /** @var string */
    public $baseDomain;
}
