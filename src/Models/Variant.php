<?php

namespace WQA\Gitbook\Models;

class Variant extends Model
{
    /** @var string */
    public $uid;

    /** @var string */
    public $ref;

    /** @var Page[] */
    public $page;
}
