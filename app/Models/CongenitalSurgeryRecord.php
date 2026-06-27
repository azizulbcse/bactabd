<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CongenitalSurgeryRecord extends Model
{
    protected $fillable = [
        'hospital_id',
        'year',
        'asd_count',
        'vsd_count',
        'tof_count',
        'pda_count'
    ];

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
