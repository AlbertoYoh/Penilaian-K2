<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Guru extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan URL Tanda Tangan Guru
     */
    public function getTtdUrlAttribute()
    {
        // Mengembalikan URL path tanda tangan, atau default jika tidak ada
        return $this->ttd ? Storage::url($this->ttd) : asset('images/default-ttd.png');
    }
}
