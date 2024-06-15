<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipality extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function departament() : BelongsTo
    {
        return $this->belongsTo(Departament::class);
    }

    public function train_stations() : HasMany
    {
        return $this->hasMany(TrainStation::class);
    }
}
