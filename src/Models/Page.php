<?php

namespace WQA\Gitbook\Models;

class Page extends Model
{
    /** @var string */
    public $uid;

    /** @var string */
    public $title;

    /** @var string */
    public $description;

    /** @var string */
    public $path;

    /** @var string */
    public $kind;

    /** @var Page[] */
    public $pages;
}
