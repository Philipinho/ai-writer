<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{

    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            $columnName = static::getUuidColumn();

            $model->$columnName = Str::uuid4();
        });
    }

    public function getUuidAttribute()
    {
        $columnName = static::getUuidColumn();

        return $this->attributes[$columnName];
    }

    protected static function getUuidColumn()
    {
        if (isset(static::$uuidColumn)) {
            return static::$uuidColumn;
        }
        return 'uuid';
    }

}
