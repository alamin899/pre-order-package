<?php

namespace PreOrder\PreOrderBackend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'users';
    protected $guarded = [];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'po_role_user', 'user_id', 'role_id');
    }
}