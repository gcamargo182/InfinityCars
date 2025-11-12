<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVeiculo extends Model
{
    use HasFactory;
    
    protected $table = 'tipos_veiculos';
    
    protected $fillable = [
        'nome',
        'descricao',
        'status'
    ];

    /**
     * Relacionamento com a tabela veiculos
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'tipo_veiculo_id');
    }
}
