<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mapel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function karya(): HasMany
    {
        return $this->hasMany(Karya::class);
    }

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }

    public function guru(): HasMany
    {
        return $this->hasMany(Guru::class);
    }
}
