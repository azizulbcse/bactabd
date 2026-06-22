<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurgeryType extends Model
{
    protected $fillable = ['name', 'sort_order', 'status'];
}
