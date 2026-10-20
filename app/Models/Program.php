<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $guarded = [];

    protected $casts = ['apa_kami_buat' => 'array', 'isi_pek' => 'array', 'faq' => 'array'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function kempens(): HasMany
    {
        return $this->hasMany(Kempen::class);
    }

    public function laporan(): HasMany
    {
        return $this->hasMany(LaporanImpak::class);
    }
}
