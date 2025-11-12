<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('versao')->nullable();
            $table->string('ano')->nullable();
            $table->string('motorizacao')->nullable();
            $table->string('combustivel')->nullable();
            $table->string('transmissao')->nullable();
            $table->string('direcao')->nullable();
            $table->foreignId('tipo_veiculo_id')->nullable();
            $table->foreignId('marca_id')->nullable()->constrained('marcas')->onDelete('cascade');
            $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo');
            $table->string('km')->nullable();
            $table->text('descricao')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modelos');
    }
}
