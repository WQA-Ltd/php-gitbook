<?php

namespace WQA\Gitbook\Models;

abstract class Model
{
    public static function createFromApi(string $jsonString): self
    {
        $data = json_decode($jsonString);

        $self = new static;

        foreach ($data as $key => $value) {
            $self->{$key} = $value;
        }

        return $self;
    }
}
