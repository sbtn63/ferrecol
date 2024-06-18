<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departament extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function minicipalities() : HasMany
    {
        return $this->hasMany(Municipality::class);
    }
}
