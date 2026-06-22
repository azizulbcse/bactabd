<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HospitalSurgeryRecord extends Model
{
    protected $fillable = ['hospital_id', 'surgery_type_id', 'year', 'data_count'];

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function surgeryType(): BelongsTo
    {
        return $this->belongsTo(SurgeryType::class, 'surgery_type_id');
    }
}
