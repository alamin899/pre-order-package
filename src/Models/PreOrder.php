<?php

namespace PreOrder\PreOrderBackend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use PreOrder\PreOrderBackend\Traits\SoftDeletedBy;

class PreOrder extends Model
{
    use HasFactory,SoftDeletes,SoftDeletedBy;

    protected $table = 'po_preorders';
    protected $fillable = ['customer_name', 'customer_phone', 'customer_email', 'quantity', 'total_amount', 'status','deleted_by_id'];

    public function preOrderProducts(): HasMany
    {
        return $this->hasMany(PreOrderProducts::class, 'order_id', 'id');
    }
}