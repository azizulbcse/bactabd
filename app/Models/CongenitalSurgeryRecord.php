<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CongenitalSurgeryRecord extends Model
{
    use SoftDeletes;


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
