<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hospital extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];
   public function committeeMembers(): HasMany
    {
        return $this->hasMany(CommitteeMember::class, 'hospital_id');
    }
}
