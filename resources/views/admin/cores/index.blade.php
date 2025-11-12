@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Veículos')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-palette me-2"></i>
                Gestão de Cores
            </h2>
            <a href="{{ route('admin.cores.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Nova Cor
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
                                <h6 class="card-title">Total de Cores</h6>
                                <h2>{{ $cores->count() ?? 0 }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-palette fa-2x"></i>
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
                                <h6 class="card-title">Ativas</h6>
                                <h2>{{ $cores->where('status', 'Ativo')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-palette fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Inativo</h6>
                                <h2>{{ $cores->where('status', 'Inativo')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-palette fa-2x"></i>
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
                                <h6 class="card-title">Cores Populares</h6>
                                <h2>0</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-fire fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela de Cores -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>
                    Paleta de Cores
                </h5>
            </div>
            <div class="card-body">
                <!-- Filtros -->
                <form method="GET" action="{{ route('admin.cores.index') }}">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" name="busca" class="form-control" placeholder="Buscar por nome da cor..." value="{{ request('busca') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="cor" class="form-select">
                                <option value="">Todas as Cores</option>
                                @foreach($coresDisponiveis as $nome)
                                    <option value="{{ $nome }}" {{ request('cor') == $nome ? 'selected' : '' }}>{{ ucfirst($nome) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="tons" class="form-select">
                                <option value="">Todos os Tons</option>
                                @foreach($tonsDisponiveis as $tom)
                                    <option value="{{ $tom }}" {{ request('tons') == $tom ? 'selected' : '' }}>{{ ucfirst($tom) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Filtrar
                            </button>
                            @if(request('busca') || request('cor') || request('tons'))
                                <a href="{{ route('admin.cores.index') }}" class="btn btn-outline-secondary w-100 mt-2">
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
                                <th>Nome da Cor</th>
                                <th>Tonalidade</th>
                                <th>Descrição</th>
                                <th>Status</th>
                                <th>Data Criação</th>
                                <th>Data Atualização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cores ?? [] as $cor)
                            <tr>
                                <td>{{ $cor->id }}</td>
                                <td>{{ $cor->nome }}</td>
                                <td>{{ $cor->tons }}</td>
                                <td>{{ $cor->descricao ?? '-' }}</td>
                                <td>
                                    @if($cor->status === 'Ativo')
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-danger">Inativo</span>
                                    @endif
                                </td>
                                <td>{{ $cor->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $cor->updated_at->format('d/m/Y H:i') }}</td>

                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.cores.edit', $cor->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.cores.destroy', $cor->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta cor?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <span class="text-muted">Nenhuma cor cadastrada ainda.</span>
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