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

    /** URL borang BCL untuk dibenamkan di laman sendiri (ciri embed rasmi BCL), atau null jika tiada. */
    public function urlBenam(): ?string
    {
        if (! $this->pautan_bcl || ! preg_match('#^https://[a-z0-9-]+\.bcl\.my/form/[A-Za-z0-9_-]+$#', $this->pautan_bcl)) {
            return null;
        }

        return str_replace('.bcl.my/form/', '.bcl.my/embed/form/', $this->pautan_bcl);
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
        return $this->unit === 'RM' ? 'RM'.number_format($n) : $n.' '.__($this->unit);
    }
}
