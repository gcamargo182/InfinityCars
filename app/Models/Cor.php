<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
    use HasFactory;
    
    protected $table = 'cores';
    
    protected $fillable = [
        'nome',
        'tons',
        'descricao',
        'status'
    ];

    /**
     * Relacionamento com a tabela veiculos
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'cor_id');
    }
}
