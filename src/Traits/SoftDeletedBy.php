<?php

namespace PreOrder\PreOrderBackend\Traits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
trait SoftDeletedBy
{
    public static function bootSoftDeletesWithDeletedBy()
    {
        static::deleting(function (Model $model) {
            if ($model->usesSoftDeletes() && Auth::check()) {
                $model->deleted_by_id = Auth::id();
                $model->saveQuietly();
            }
        });
    }

    public function usesSoftDeletes()
    {
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($this));
    }
}