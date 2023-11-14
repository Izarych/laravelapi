<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'lecture_id',
        'order'
    ];

    public function class() : BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }

    public function lecture(): BelongsTo
    {
        return $this->belongsTo(Lecture::class);
    }
}
