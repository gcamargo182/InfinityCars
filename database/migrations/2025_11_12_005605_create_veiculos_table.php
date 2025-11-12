<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marca_id')->constrained('marcas')->onDelete('cascade');
            $table->foreignId('modelo_id')->constrained('modelos')->onDelete('cascade');
            $table->foreignId('tipo_veiculo_id')->constrained('tipos_veiculos')->onDelete('cascade');
            $table->foreignId('cor_id')->constrained('cores')->onDelete('cascade');
            $table->string('placa')->unique();
            $table->string('cidade')->nullable();
            $table->decimal('preco', 10, 2);
            $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo');
            $table->string('foto_url_1')->nullable();
            $table->string('foto_url_2')->nullable();
            $table->string('foto_url_3')->nullable();
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculos');
    }
}
