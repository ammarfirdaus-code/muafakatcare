<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanImpak extends Model
{
    protected $guarded = [];

    protected $casts = ['terbit' => 'boolean', 'gambar' => 'array', 'tarikh_agihan' => 'date'];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function scopeTerbit(Builder $q): Builder
    {
        return $q->where('terbit', true)->orderByDesc('bulan');
    }
}
