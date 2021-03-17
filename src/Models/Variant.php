<?php

namespace WQA\Gitbook\Models;

class Variant extends Model
{
    /** @var string */
    public $uid;

    /** @var string */
    public $ref;

    /** @var string */
    public $title;

    /** @var Page[] */
    public $page;
}
