<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;
    
    protected $table = 'veiculos';
    
    protected $fillable = [
        'marca_id',
        'modelo_id',
        'tipo_veiculo_id',
        'cor_id',
        'placa',
        'cidade',
        'preco',
        'status',
        'foto_url_1',
        'foto_url_2',
        'foto_url_3',
        'descricao'
    ];

    protected $casts = [
        'preco' => 'decimal:2',
    ];

    /**
     * Relacionamento com a tabela marcas
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    /**
     * Relacionamento com a tabela modelos
     */
    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }

    /**
     * Relacionamento com a tabela tipos_veiculos
     */
    public function tipoVeiculo()
    {
        return $this->belongsTo(TipoVeiculo::class, 'tipo_veiculo_id');
    }

    /**
     * Relacionamento com a tabela cores
     */
    public function cor()
    {
        return $this->belongsTo(Cor::class, 'cor_id');
    }
}
