<?php

namespace WQA\Gitbook\Models;

class Asset extends Model
{
    /** @var string */
    public $uid;

    /** @var string */
    public $name;

    /** @var string */
    public $downloadURL;

    /** @var string */
    public $contentType;
}
