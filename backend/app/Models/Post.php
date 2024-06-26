<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCreatedAtForHumansAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }


    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function train_station() : BelongsTo
    {
        return $this->belongsTo(TrainStation::class);
    }
}
