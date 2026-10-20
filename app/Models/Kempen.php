<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kempen extends Model
{
    protected $guarded = [];

    protected $casts = ['aktif' => 'boolean'];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function scopeAktif(Builder $q): Builder
    {
        return $q->where('aktif', true)->orderBy('susunan');
    }

    public function peratus(): ?int
    {
        if (! $this->sasaran || $this->terkumpul === null) {
            return null;
        }

        return (int) min(100, round($this->terkumpul / $this->sasaran * 100));
    }

    public function format(int $n): string
    {
        return $this->unit === 'RM' ? 'RM'.number_format($n) : $n.' '.$this->unit;
    }
}
