<?php

namespace ChrisReedIO\Inteliment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->unique_id = Str::ulid();
        });
    }
}
