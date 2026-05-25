<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penduduk extends Model
{
    // ... kode fillable sebelumnya ...
    // Relasi: Penduduk memiliki banyak Surat
    public function surats(): HasMany
    {
        return $this->hasMany(Surat::class);
    }
}
