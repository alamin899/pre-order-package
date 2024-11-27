<?php

namespace PreOrder\PreOrderBackend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PreOrder\PreOrderBackend\Traits\SoftDeletedBy;

class Product extends Model
{
    use HasFactory,SoftDeletes,SoftDeletedBy;

    protected $table = 'po_products';
    protected $fillable = ['name','slug','description','price','status'];
}