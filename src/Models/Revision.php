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

    protected function hydrate(): void
    {
        $this->variants = $this->hydrateModels($this->variants, Variant::class);
        $this->assets = $this->hydrateModels($this->assets, Asset::class);
    }
}
