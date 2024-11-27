<?php

namespace PreOrder\PreOrderBackend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use PreOrder\PreOrderBackend\Traits\SoftDeletedBy;

class Role extends Model
{
    use HasFactory,SoftDeletes,SoftDeletedBy;

    protected $table = 'po_roles';
    protected $fillable = ['name','description','status','deleted_by_id'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'po_role_user', 'role_id', 'user_id');
    }
}