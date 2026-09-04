<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValvularSurgeryRecord extends Model
{
    use SoftDeletes;

    protected $table = 'valvular_surgery_records';

    protected $fillable = [
        'hospital_id',
        'year',
        'mvr_count',
        'avr_count',
        'dvr_count'
    ];

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
