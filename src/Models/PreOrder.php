<?php

namespace PreOrder\PreOrderBackend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreOrder extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'po_preorders';
    protected $fillable = ['product_id', 'customer_name', 'customer_phone', 'customer_email', 'quantity', 'total_amount', 'status','deleted_by_id'];
}