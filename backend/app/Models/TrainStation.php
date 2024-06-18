<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainStation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function municipality() : BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }
}
