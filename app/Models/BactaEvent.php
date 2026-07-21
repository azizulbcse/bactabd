<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BactaEvent extends Model
{
    use HasFactory;

    protected $table = 'bacta_events';

    protected $fillable = [
        'title',
        'venue',
        'event_date',
        'event_banner',
        'status',
        'created_by',
        'updated_by'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
