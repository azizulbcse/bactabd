<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalArticle extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'journal_articles';

    protected $fillable = [
        'bacta_journal_id',
        'article_title',
        'author_name',
        'pdf_file',
        'status'
    ];

    public function journal()
    {
        return $this->belongsTo(BactaJournal::class, 'bacta_journal_id', 'id');
    }
}
