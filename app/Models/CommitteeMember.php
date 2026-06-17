<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommitteeMember extends Model
{
    protected $fillable = [
        'name',
        'member_category',
        'member_pic',
        'sort_order',
        'status',
        'hospital_id',
        'medical_designation_id',
        'bacta_designation_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function medicalDesignation(): BelongsTo
    {
        return $this->belongsTo(MedicalDesignation::class, 'medical_designation_id');
    }

    public function bactaDesignation(): BelongsTo
    {
        return $this->belongsTo(BactaDesignation::class, 'bacta_designation_id');
    }
}
