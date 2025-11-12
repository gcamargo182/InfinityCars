@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Nova Cor')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-plus me-2"></i>
                Adicionar Nova Cor
            </h2>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-palette me-2"></i>
                    Dados da Cor
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.cores.store') }}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="cor" name="cor" required>
                                    <option value="">Selecione a Cor</option>
                                    <option value="Amarelo" {{ old('cor') == 'Amarelo' ? 'selected' : '' }}>Amarelo</option>
                                    <option value="Azul" {{ old('cor') == 'Azul' ? 'selected' : '' }}>Azul</option>
                                    <option value="Bege" {{ old('cor') == 'Bege' ? 'selected' : '' }}>Bege</option>
                                    <option value="Branco" {{ old('cor') == 'Branco' ? 'selected' : '' }}>Branco</option>
                                    <option value="Cinza" {{ old('cor') == 'Cinza' ? 'selected' : '' }}>Cinza</option>
                                    <option value="Dourado" {{ old('cor') == 'Dourado' ? 'selected' : '' }}>Dourado</option>
                                    <option value="Marrom" {{ old('cor') == 'Marrom' ? 'selected' : '' }}>Marrom</option>
                                    <option value="Prata" {{ old('cor') == 'Prata' ? 'selected' : '' }}>Prata</option>
                                    <option value="Preto" {{ old('cor') == 'Preto' ? 'selected' : '' }}>Preto</option>
                                    <option value="Roxo" {{ old('cor') == 'Roxo' ? 'selected' : '' }}>Roxo</option>
                                    <option value="Verde" {{ old('cor') == 'Verde' ? 'selected' : '' }}>Verde</option>
                                    <option value="Vermelho" {{ old('cor') == 'Vermelho' ? 'selected' : '' }}>Vermelho</option>
                                    <option value="Vinho" {{ old('cor') == 'Vinho' ? 'selected' : '' }}>Vinho</option>
                                    <option value="Indefinida" {{ old('cor') == 'Indefinida' ? 'selected' : '' }}>Indefinida</option>
                                </select>
                                <label for="cor">Cor</label>
                                @error('cor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="tons" name="tons" required>
                                    <option value="">Selecione o tom</option>
                                    <option value="Sólido" {{ old('tons') == 'Sólido' ? 'selected' : '' }}>Sólido</option>
                                    <option value="Metálico" {{ old('tons') == 'Metálico' ? 'selected' : '' }}>Metálico</option>
                                    <option value="Perolizado" {{ old('tons') == 'Perolizado' ? 'selected' : '' }}>Perolizado</option>
                                    <option value="Fosco" {{ old('tons') == 'Fosco' ? 'selected' : '' }}>Fosco</option>
                                </select>
                                <label for="tons">Tom da Cor</label>
                                @error('tons')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                            <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Digite uma descrição da cor">{{ old('descricao') }}</textarea>
                            @error('descricao')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.cores.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Salvar Cor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const colorInput = document.getElementById('codigo_hex');
    const colorPreview = document.getElementById('color-preview');
    const hexDisplay = document.getElementById('hex-display');
    
    colorInput.addEventListener('input', function() {
        const color = this.value;
        colorPreview.style.backgroundColor = color;
        hexDisplay.textContent = color.toUpperCase();
    });
});
</script>

@endsection