@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Veículos')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-tags me-2"></i>
                Gestão de Marcas
            </h2>
            <a href="{{ route('admin.marcas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Nova Marca
            </a>
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

        <!-- Card de Estatísticas -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Total de Marcas</h6>
                                <h2>0</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-tags fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Ativos</h6>
                                <h2>{{ $marcas->where('status', 'Ativo')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-tags fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Inativos</h6>
                                <h2>{{ $marcas->where('status', 'Inativo')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fa-solid fa-list fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Marcas Premium</h6>
                                <h2>0</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-crown fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela de Marcas -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>
                    Lista de Marcas
                </h5>
            </div>
            <div class="card-body">
                <!-- Filtros -->
                <form method="GET" action="{{ route('admin.marcas.index') }}">
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <input type="text" name="busca" class="form-control" placeholder="Buscar por nome da marca..." value="{{ request('busca') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="categoria" class="form-select">
                                <option value="">Todas as Categorias</option>
                                @foreach($categoriasDisponiveis as $categoria)
                                    <option value="{{ $categoria }}" {{ request('categoria') == $categoria ? 'selected' : '' }}>
                                        {{ ucfirst($categoria) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Filtrar
                            </button>
                        </div>
                        <div class="col-md-2">
                            @if(request('busca') || request('categoria'))
                                <a href="{{ route('admin.marcas.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-times"></i> Limpar
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

                <!-- Tabela -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome da Marca</th>
                                <th>Origem</th>
                                <th>País de Origem</th>
                                <th>Categoria</th>
                                <th>Status</th>
                                <th>Data Criação</th>
                                <th>Data Atualização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($marcas ?? [] as $marca)
                            <tr>
                                <td>{{ $marca->id }}</td>
                                <td>{{ $marca->nome }}</td>
                                <td>{{ $marca->origem }}</td>
                                <td>{{ $marca->pais_origem }}</td>
                                <td>{{ $marca->categoria }}</td>
                                <td>
                                    @if($marca->status === 'Ativo')
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-danger">Inativo</span>
                                    @endif
                                </td>
                                <td>{{ $marca->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $marca->updated_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.marcas.edit', $marca->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.marcas.destroy', $marca->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta marca?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <span class="text-muted">Nenhuma marca cadastrada ainda.</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection