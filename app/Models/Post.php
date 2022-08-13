<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'files' => AsCollection::class,
    ];

    protected $fillable = ["title", "description", "files", "space_id"];

    public function space(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Space::class);
    }
}
