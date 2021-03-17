<?php

namespace WQA\Gitbook\Models;

class Revision extends Model
{
    /** @var string */
    public $uid;

    /** @var string[] */
    public $parents;

    /** @var Variant[] */
    public $variants;

    /** @var Asset[] */
    public $assets;
}
