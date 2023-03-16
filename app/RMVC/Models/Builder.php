<?php

namespace App\RMVC\Models;


class Builder
{
    protected Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes): object
    {
        $this->model->fill($attributes);
        return $this->model;
    }
}