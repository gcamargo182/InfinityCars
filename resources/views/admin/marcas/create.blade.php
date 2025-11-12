@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Nova Marca')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-plus me-2"></i>
                Adicionar Nova Marca
            </h2>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-tags me-2"></i>
                    Dados da Marca
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.marcas.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nome" type="text" name="nome" value="{{ old('nome') }}" required autofocus>
                                <label for="nome">Nome da Marca</label>
                                @error('nome')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="origem" name="origem" required>
                                    <option value="Nacional" {{ old('origem') == 'Nacional' ? 'selected' : '' }}>Nacional</option>
                                    <option value="Importado" {{ old('origem') == 'Importado' ? 'selected' : '' }}>Importado</option>
                                </select>
                                <label for="origem">Origem</label>
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
                                    <option value="">Selecione a categoria</option>
                                    <option value="Aplicativos" {{ old('categoria') == 'Aplicativos' ? 'selected' : '' }}>Aplicativos</option>
                                    <option value="Esportivos" {{ old('categoria') == 'Esportivos' ? 'selected' : '' }}>Esportivos</option>
                                    <option value="Família" {{ old('categoria') == 'Família' ? 'selected' : '' }}>Família</option>
                                    <option value="Grandes" {{ old('categoria') == 'Grandes' ? 'selected' : '' }}>Grandes</option>
                                    <option value="Híbridos" {{ old('categoria') == 'Híbridos' ? 'selected' : '' }}>Híbridos</option>
                                    <option value="Importados" {{ old('categoria') == 'Importados' ? 'selected' : '' }}>Importados</option>
                                    <option value="Luxo" {{ old('categoria') == 'Luxo' ? 'selected' : '' }}>Luxo</option>                            
                                    <option value="Populares" {{ old('categoria') == 'Populares' ? 'selected' : '' }}>Populares</option>
                                </select>
                                <label for="categoria">Categoria</label>
                                @error('categoria')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="pais_origem" type="text" name="pais_origem" value="{{ old('pais_origem') }}">
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
                        <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Digite uma descrição da marca...">{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.marcas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Salvar Marca
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection