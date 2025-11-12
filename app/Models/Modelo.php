<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;
    
    protected $table = 'modelos';
    
    protected $fillable = [
        'nome',
        'versao',
        'ano',
        'motorizacao',
        'combustivel',
        'transmissao',
        'direcao',
        'km',
        'marca_id',
        'tipo_veiculo_id',
        'descricao',
        'status'
    ];

    /**
     * Relacionamento com a tabela marcas
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    /**
     * Relacionamento com a tabela tipos_veiculos
     */
    public function tipoVeiculo()
    {
        return $this->belongsTo(TipoVeiculo::class, 'tipo_veiculo_id');
    }

    /**
     * Relacionamento com a tabela veiculos
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'modelo_id');
    }
}
