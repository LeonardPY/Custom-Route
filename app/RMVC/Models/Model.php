<?php

namespace App\RMVC\Models;


abstract class Model
{
    protected array $attributes = [];

    public function setAttribute($key, $value) : object
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function __set($key, $value): void
    {
        $this->setAttribute($key, $value);
    }

    public function __get($key) : string|null
    {
        return $this->attributes[$key] ?? null;
    }

    public static function __callStatic($name, $arguments)
    {
        return static::query()->{$name}(...$arguments);
    }

    public static function query(): object
    {
        $model = new static;
        return (new Builder($model));
    }

    public function fill(array $attributes): object
    {
        foreach ($attributes as $name => $value) {
            $this->setAttribute($name, $value);
        }

        return $this;
    }

    public function save(): bool
    {
        return true;
    }
}