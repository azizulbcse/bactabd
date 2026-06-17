<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BactaDesignation extends Model
{
    protected $fillable = [
        'title',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];


    public function committeeMembers(): HasMany
    {
        return $this->hasMany(CommitteeMember::class, 'bacta_designation_id');
    }
}
