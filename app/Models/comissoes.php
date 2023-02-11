<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comissoes extends Model
{
    use HasFactory;

    public function comissoesLancadas()
    {
        return $this->hasMany(ComissoesCorretoresLancadas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);   
    }



}
