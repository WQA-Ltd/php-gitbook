<?php

namespace WQA\Gitbook\Models;

class Revision extends Model
{
    /** @var string */
    public $uid;

    /** @var Variant[] */
    public $variants;

    /** @var Asset[] */
    public $assets;
}
