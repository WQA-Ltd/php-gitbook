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
        $this->hydrateVariants();
        $this->hydrateAssets();
    }

    protected function hydrateVariants(): void
    {
        $variantModels = [];

        foreach ($this->variants as $variant) {
            $variantModels[] = Variant::createFromApi(json_encode($variant));
        }

        $this->variants = $variantModels;
    }

    protected function hydrateAssets(): void
    {
        $assetModels = [];

        foreach ($this->assets as $asset) {
            $assetModels[] = Asset::createFromApi(json_encode($asset));
        }

        $this->assets = $assetModels;
    }
}
