@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Veículos')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-car me-2"></i>
                Tipos de Veículos
            </h2>
            <a href="{{ route('admin.tipos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Novo Tipo
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
                                <h6 class="card-title">Total de Tipos</h6>
                                <h2>{{ $tipos->count() ?? 0 }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-layer-group fa-2x"></i>
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
                                <h6 class="card-title">Buggy</h6>
                                <h2>{{ $tipos->where('nome', 'Buggy')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-truck-pickup fa-2x"></i>
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
                                <h6 class="card-title">Conversível</h6>
                                <h2>{{ $tipos->where('nome', 'Conversível')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-car fa-2x"></i>
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
                                <h6 class="card-title">Coupé</h6>
                                <h2>{{ $tipos->where('nome', 'Coupé')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-car fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Hatch</h6>
                                <h2>{{ $tipos->where('nome', 'Hatch')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-car fa-2x"></i>
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
                                <h6 class="card-title">Minivan</h6>
                                <h2>{{ $tipos->where('nome', 'Minivan')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fa-solid fa-van-shuttle fa-2x"></i>
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
                                <h6 class="card-title">Motocicletas</h6>
                                <h2>{{ $tipos->where('nome', 'Motocicletas')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-motorcycle fa-2x"></i>
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
                                <h6 class="card-title">Perua/SW</h6>
                                <h2>{{ $tipos->where('nome', 'Perua/SW')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-car fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Picape</h6>
                                <h2>{{ $tipos->where('nome', 'Picape')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-car fa-2x"></i>
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
                                <h6 class="card-title">Sedã</h6>
                                <h2>{{ $tipos->where('nome', 'Sedã')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-car fa-2x"></i>
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
                                <h6 class="card-title">SUV</h6>
                                <h2>{{ $tipos->where('nome', 'SUV')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-car fa-2x"></i>
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
                                <h6 class="card-title">Van/Utilitário/Furgão</h6>
                                <h2>{{ $tipos->where('nome', 'Van/Utilitário/Furgão')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-truck fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabela de Veículos -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>
                    Lista de Tipos de Veículos
                </h5>
            </div>
            <div class="card-body">
                <!-- Filtros -->
                <form method="GET" action="{{ route('admin.tipos.index') }}">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" name="busca" class="form-control" placeholder="Buscar por nome do tipo..." value="{{ request('busca') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="carroceria" class="form-select">
                                <option value="">Todas as Carrocerias</option>
                                @foreach($carrocerias as $carroceria)
                                    <option value="{{ $carroceria }}" {{ request('carroceria') == $carroceria ? 'selected' : '' }}>
                                        {{ ucfirst($carroceria) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Filtrar
                            </button>
                            @if(request('busca') || request('carroceria'))
                                <a href="{{ route('admin.tipos.index') }}" class="btn btn-outline-secondary w-100 mt-2">
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
                                <th>Nome do Tipo</th>
                                <th>Carroceria</th>
                                <th>Status</th>
                                <th>Data Criação</th>
                                <th>Data Atualização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tipos ?? [] as $tipo)
                            <tr>
                                <td>{{ $tipo->id }}</td>
                                <td>{{ $tipo->nome }}</td>
                                <td>{{ ucfirst($tipo->nome) }}</td>
                                <td>
                                    @if($tipo->status === 'Ativo')
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-danger">Inativo</span>
                                    @endif
                                </td>
                                <td>{{ $tipo->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $tipo->updated_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.tipos.edit', $tipo->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.tipos.destroy', $tipo->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este tipo?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <span class="text-muted">Nenhum tipo de veículo cadastrado ainda.</span>
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