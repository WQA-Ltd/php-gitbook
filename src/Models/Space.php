<?php

namespace WQA\Gitbook\Models;

class Space extends Model
{
    /** @var string */
    public $uid;

    /** @var string */
    public $name;

    /** @var string */
    public $baseName;

    /** @var bool */
    public $private;

    /** @var bool */
    public $unlisted;
}
