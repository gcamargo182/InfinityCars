@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Novo Tipo')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-plus me-2"></i>
                Adicionar Novo Tipo
            </h2>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-tags me-2"></i>
                    Dados do Tipo
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.tipos.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="carroceria" name="carroceria" required>
                                    <option value="">Selecione a Carroceria</option>
                                    <option value="Buggy" {{ old('carroceria') == 'Buggy' ? 'selected' : '' }}>Buggy</option>
                                    <option value="Conversível" {{ old('carroceria') == 'Conversível' ? 'selected' : '' }}>Conversível</option>
                                    <option value="Coupé" {{ old('carroceria') == 'Coupé' ? 'selected' : '' }}>Coupé</option>
                                    <option value="Hatch" {{ old('carroceria') == 'Hatch' ? 'selected' : '' }}>Hatch</option>
                                    <option value="Minivan" {{ old('carroceria') == 'Minivan' ? 'selected' : '' }}>Minivan</option>
                                    <option value="Motocicletas" {{ old('carroceria') == 'Motocicletas' ? 'selected' : '' }}>Motocicletas</option>
                                    <option value="Perua/SW" {{ old('carroceria') == 'Perua/SW' ? 'selected' : '' }}>Perua/SW</option>
                                    <option value="Picape" {{ old('carroceria') == 'Picape' ? 'selected' : '' }}>Picape</option>
                                    <option value="Sedã" {{ old('carroceria') == 'Sedã' ? 'selected' : '' }}>Sedã</option>
                                    <option value="SUV" {{ old('carroceria') == 'SUV' ? 'selected' : '' }}>SUV</option>
                                    <option value="Van/Utilitário/Furgão" {{ old('carroceria') == 'Van/Utilitário/Furgão' ? 'selected' : '' }}>Van/Utilitário/Furgão</option>
                                </select>
                                <label for="carroceria">Carroceria</label>
                                @error('carroceria')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">Selecione o status</option>
                                    <option value="Ativo" {{ old('status') == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                    <option value="Inativo" {{ old('status') == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <label for="status">Status</label>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Digite uma descrição do tipo de veículo...">{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.tipos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Salvar Tipo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function selecionarTipo() {
    const selectExistente = document.getElementById('tipo_existente');
    const inputNovo = document.getElementById('carroceria');
    
    if (selectExistente.value && selectExistente.value !== 'novo') {
        // Se selecionou um tipo existente, preenche o campo de texto
        inputNovo.value = selectExistente.value;
        inputNovo.setAttribute('readonly', true);
        inputNovo.classList.add('bg-light');
    } else if (selectExistente.value === 'novo') {
        // Se selecionou "novo", limpa e habilita o campo de texto
        inputNovo.value = '';
        inputNovo.removeAttribute('readonly');
        inputNovo.classList.remove('bg-light');
        inputNovo.focus();
    } else {
        // Se não selecionou nada, limpa e habilita o campo
        inputNovo.value = '';
        inputNovo.removeAttribute('readonly');
        inputNovo.classList.remove('bg-light');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Configuração inicial do formulário
    const inputNovo = document.getElementById('carroceria');
    inputNovo.addEventListener('input', function() {
        // Se o usuário digitar algo no campo novo, limpa a seleção do select
        if (this.value.trim() !== '') {
            document.getElementById('tipo_existente').value = '';
        }
    });
});
</script>

@endsection