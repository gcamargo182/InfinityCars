@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Editar Cor')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-edit me-2"></i>
                Editar Cor: {{ $cor->nome ?? 'Cor' }}
            </h2>
        </div>

        <!-- Mensagens de Feedback -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Erro(s) de validação:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-palette me-2"></i>
                    Dados da Cor
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.cores.update', $cor->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="cor" name="nome" required>
                                    <option value="">Selecione a Cor</option>
                                    <option value="Amarelo" {{ (old('nome') ?? $cor->nome) == 'Amarelo' ? 'selected' : '' }}>Amarelo</option>
                                    <option value="Azul" {{ (old('nome') ?? $cor->nome) == 'Azul' ? 'selected' : '' }}>Azul</option>
                                    <option value="Bege" {{ (old('nome') ?? $cor->nome) == 'Bege' ? 'selected' : '' }}>Bege</option>
                                    <option value="Branco" {{ (old('nome') ?? $cor->nome) == 'Branco' ? 'selected' : '' }}>Branco</option>
                                    <option value="Cinza" {{ (old('nome') ?? $cor->nome) == 'Cinza' ? 'selected' : '' }}>Cinza</option>
                                    <option value="Dourado" {{ (old('nome') ?? $cor->nome) == 'Dourado' ? 'selected' : '' }}>Dourado</option>
                                    <option value="Marrom" {{ (old('nome') ?? $cor->nome) == 'Marrom' ? 'selected' : '' }}>Marrom</option>
                                    <option value="Prata" {{ (old('nome') ?? $cor->nome) == 'Prata' ? 'selected' : '' }}>Prata</option>
                                    <option value="Preto" {{ (old('nome') ?? $cor->nome) == 'Preto' ? 'selected' : '' }}>Preto</option>
                                    <option value="Roxo" {{ (old('nome') ?? $cor->nome) == 'Roxo' ? 'selected' : '' }}>Roxo</option>
                                    <option value="Verde" {{ (old('nome') ?? $cor->nome) == 'Verde' ? 'selected' : '' }}>Verde</option>
                                    <option value="Vermelho" {{ (old('nome') ?? $cor->nome) == 'Vermelho' ? 'selected' : '' }}>Vermelho</option>
                                    <option value="Vinho" {{ (old('nome') ?? $cor->nome) == 'Vinho' ? 'selected' : '' }}>Vinho</option>
                                    <option value="Indefinida" {{ (old('nome') ?? $cor->nome) == 'Indefinida' ? 'selected' : '' }}>Indefinida</option>
                                </select>
                                <label for="cor">Cor</label>
                                @error('nome')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="tons" name="tons" required>
                                    <option value="">Selecione o tom</option>
                                    <option value="Sólido" {{ (old('tons') ?? $cor->tons) == 'Sólido' ? 'selected' : '' }}>Sólido</option>
                                    <option value="Metálico" {{ (old('tons') ?? $cor->tons) == 'Metálico' ? 'selected' : '' }}>Metálico</option>
                                    <option value="Perolizado" {{ (old('tons') ?? $cor->tons) == 'Perolizado' ? 'selected' : '' }}>Perolizado</option>
                                    <option value="Fosco" {{ (old('tons') ?? $cor->tons) == 'Fosco' ? 'selected' : '' }}>Fosco</option>
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
                                    <option value="Ativo" {{ (old('status') ?? $cor->status) == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                    <option value="Inativo" {{ (old('status') ?? $cor->status) == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <label for="status">Status</label>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                        <div class="mb-3">
                          <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Digite uma descrição da cor">{{ old('descricao') ?? $cor->descricao }}</textarea>
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
                            Atualizar Cor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection