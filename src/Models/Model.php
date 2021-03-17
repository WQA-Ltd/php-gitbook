<?php

namespace WQA\Gitbook\Models;

abstract class Model
{
    public static function createFromApi(string $jsonString): self
    {
        $data = json_decode($jsonString);

        $self = new static;

        if ($data) {
            foreach ($data as $key => $value) {
                $self->{$key} = $value;
            }

            $self->hydrate();
        }

        return $self;
    }

    public static function createMultipleFromApi(string $jsonString): array
    {
        $data = json_decode($jsonString);
        $models = [];

        if (property_exists($data, 'items')) {
            foreach ($data->items as $item) {
                $models[] = self::createFromApi(json_encode($item));
            }
        }

        return $models;
    }

    protected function hydrate(): void
    {
        //
    }
}
