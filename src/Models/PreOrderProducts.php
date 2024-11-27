<?php

namespace PreOrder\PreOrderBackend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PreOrder\PreOrderBackend\Traits\SoftDeletedBy;

class PreOrderProducts extends Model
{
    use HasFactory,SoftDeletes,SoftDeletedBy;

    protected $table = 'po_preorder_products';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'total_amount', 'status','deleted_by_id'];
}