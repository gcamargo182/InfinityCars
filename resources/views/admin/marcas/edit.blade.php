@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Editar Marca')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-edit me-2"></i>
                Editar Marca: {{ $marca->nome ?? 'Marca' }}
            </h2>
        </div>

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
                    <i class="fas fa-tags me-2"></i>
                    Dados da Marca
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.marcas.update', $marca->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Marca" value="{{ old('nome') ?? $marca->nome }}" required>
                                <label for="nome">Nome da Marca</label>
                                @error('nome')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>                    
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="origem" name="origem" required>
                                    <option value="">Selecione a Origem</option>
                                    <option value="Nacional" {{ (old('origem') ?? $marca->origem) == 'Nacional' ? 'selected' : '' }}>Nacional</option>
                                    <option value="Importado" {{ (old('origem') ?? $marca->origem) == 'Importado' ? 'selected' : '' }}>Importado</option>
                                </select>
                                <label for="origem">Origem da Marca</label>
                                @error('origem')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="categoria" name="categoria" required>
                                    <option value="">Selecione a Categoria</option>
                                    <option value="Aplicativos" {{ (old('categoria') ?? $marca->categoria) == 'Aplicativos' ? 'selected' : '' }}>Aplicativos</option>
                                    <option value="Esportivos" {{ (old('categoria') ?? $marca->categoria) == 'Esportivos' ? 'selected' : '' }}>Esportivos</option>
                                    <option value="Família" {{ (old('categoria') ?? $marca->categoria) == 'Família' ? 'selected' : '' }}>Família</option>
                                    <option value="Grandes" {{ (old('categoria') ?? $marca->categoria) == 'Grandes' ? 'selected' : '' }}>Grandes</option>
                                    <option value="Híbridos" {{ (old('categoria') ?? $marca->categoria) == 'Híbridos' ? 'selected' : '' }}>Híbridos</option>
                                    <option value="Importados" {{ (old('categoria') ?? $marca->categoria) == 'Importados' ? 'selected' : '' }}>Importados</option>
                                    <option value="Luxo" {{ (old('categoria') ?? $marca->categoria) == 'Luxo' ? 'selected' : '' }}>Luxo</option>
                                    <option value="Populares" {{ (old('categoria') ?? $marca->categoria) == 'Populares' ? 'selected' : '' }}>Populares</option>
                                </select>
                                <label for="categoria">Categoria</label>
                                @error('categoria')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="pais_origem" name="pais_origem" placeholder="País de Origem" value="{{ old('pais_origem') ?? $marca->pais_origem }}" required>
                                <label for="pais_origem">País de Origem</label>
                                @error('pais_origem')
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
                                    <option value="Ativo" {{ (old('status') ?? $marca->status) == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                    <option value="Inativo" {{ (old('status') ?? $marca->status) == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <label for="status">Status</label>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Descrição da marca">{{ old('descricao') ?? $marca->descricao }}</textarea>
                                @error('descricao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.marcas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Atualizar Marca
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection