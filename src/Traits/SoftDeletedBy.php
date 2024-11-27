<?php

namespace PreOrder\PreOrderBackend\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait SoftDeletedBy
{
    public static function bootSoftDeletedBy(): void
    {
        static::deleting(function (Model $model) {
            if ($model->isUsingSoftDeletes() && Auth::check()) {
                $model->setAttribute('deleted_by_id', Auth::id());
                $model->saveQuietly();
            }
        });
    }

    public function isUsingSoftDeletes(): bool
    {
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive(static::class));
    }
}
