<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BactaJournal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bacta_journals';

    protected $fillable = [
        'title',
        'author_name',
        'volume_issue',
        'publishing_date',
        'journal_file',
        'cover_image',
        'status',
        'created_by'
    ];

    public function articles()
    {
        return $this->hasMany(JournalArticle::class, 'bacta_journal_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
