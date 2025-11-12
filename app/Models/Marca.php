<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    
    protected $table = 'marcas';
    
    protected $fillable = [
        'nome',
        'origem',
        'categoria', 
        'pais_origem',
        'descricao',
        'status'
    ];

    /**
     * Relacionamento com a tabela modelos
     */
    public function modelos()
    {
        return $this->hasMany(Modelo::class, 'marca_id');
    }

    /**
     * Relacionamento com a tabela veiculos
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'marca_id');
    }
}
