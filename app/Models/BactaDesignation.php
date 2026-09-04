<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BactaDesignation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];


    public function committeeMembers(): HasMany
    {
        return $this->hasMany(CommitteeMember::class, 'bacta_designation_id');
    }
}
