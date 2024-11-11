<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class)->where('tahun_ajaran', 'tahun_ajaran_aktif');
    }
}
