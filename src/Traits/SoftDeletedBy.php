<?php

namespace PreOrder\PreOrderBackend\Traits;

use Illuminate\Database\Eloquent\Model;
use PreOrder\PreOrderBackend\Facades\CustomAuth;

trait SoftDeletedBy
{
    public static function bootSoftDeletedBy(): void
    {
        static::deleting(function (Model $model) {
            if ($model->isUsingSoftDeletes() && CustomAuth::check()) {
                $model->setAttribute('deleted_by_id', CustomAuth::id());
                $model->saveQuietly();
            }
        });
    }

    public function isUsingSoftDeletes(): bool
    {
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive(static::class));
    }
}
