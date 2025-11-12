@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Veículos')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-clipboard-list me-2"></i>
                Gestão de Modelos
            </h2>
            <a href="{{ route('admin.modelos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Novo Modelo
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
                                <h6 class="card-title">Total de Modelos</h6>
                                <h2>{{ $modelos->count() ?? 0 }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-clipboard-list fa-2x"></i>
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
                                <h6 class="card-title">Ativos</h6>
                                <h2>{{ $modelos->where('status', 'Ativo')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-star fa-2x"></i>
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
                                <h6 class="card-title">Inativos</h6>
                                <h2>{{ $modelos->where('status', 'Inativo')->count() }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-clock fa-2x"></i>
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
                                <h6 class="card-title">Motorização</h6>
                                <h2>0</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-industry fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela de Modelos -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>
                    Lista de Modelos
                </h5>
            </div>
            <div class="card-body">
                <!-- Filtros -->
                <form method="GET" action="{{ route('admin.modelos.index') }}">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text" name="nome" class="form-control" placeholder="Buscar por nome..." value="{{ request('nome') }}">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="versao" class="form-control" placeholder="Buscar por versão..." value="{{ request('versao') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="motorizacao" class="form-select">
                                <option value="">Todas Motorizações</option>
                                @foreach($motorizacoesDisponiveis as $motorizacao)
                                    <option value="{{ $motorizacao }}" {{ request('motorizacao') == $motorizacao ? 'selected' : '' }}>
                                        {{ ucfirst($motorizacao) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="transmissao" class="form-select">
                                <option value="">Todas Transmissões</option>
                                @foreach($transmissoesDisponiveis as $transmissao)
                                    <option value="{{ $transmissao }}" {{ request('transmissao') == $transmissao ? 'selected' : '' }}>
                                        {{ ucfirst($transmissao) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="direcao" class="form-select">
                                <option value="">Todas Direções</option>
                                @foreach($direcoesDisponiveis as $direcao)
                                    <option value="{{ $direcao }}" {{ request('direcao') == $direcao ? 'selected' : '' }}>
                                        {{ ucfirst($direcao) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Filtrar
                            </button>
                            @if(request('nome') || request('versao') || request('motorizacao') || request('transmissao') || request('direcao'))
                            <a href="{{ route('admin.modelos.index') }}" class="btn btn-outline-secondary w-100 mt-2">
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
                                <th>Modelo</th>
                                <th>Versão</th>
                                <th>Ano</th>
                                <th>Motorização</th>
                                <th>Combustível</th>
                                <th>Transmissão</th>
                                <th>Direção</th>
                                <th>Marca</th>
                                <th>Carroceria</th>
                                <th>Status</th>
                                <th>Data Criação</th>
                                <th>Data Atualização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($modelos ?? [] as $modelo)
                            <tr>
                                <td>{{ $modelo->id }}</td>
                                <td>{{ $modelo->nome }}</td>
                                <td>{{ $modelo->versao ?? '-' }}</td>
                                <td>{{ $modelo->ano ?? '-' }}</td>
                                <td>{{ $modelo->motorizacao ?? '-' }}</td>
                                <td>{{ $modelo->combustivel ?? '-' }}</td>
                                <td>{{ $modelo->transmissao ?? '-' }}</td>
                                <td>{{ $modelo->direcao ?? '-' }}</td>
                                <td>{{ $modelo->marca->nome ?? '-' }}</td>
                                <td>{{ $modelo->tipoVeiculo->nome ?? '-' }}</td>
                                <td>
                                    @if($modelo->status === 'Ativo')
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-danger">Inativo</span>
                                    @endif
                                </td>
                                <td>{{ $modelo->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $modelo->updated_at->format('d/m/Y H:i') }}</td>

                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.modelos.edit', $modelo->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.modelos.destroy', $modelo->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este modelo?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="14" class="text-center py-5">
                                    <span class="text-muted">Nenhum modelo cadastrado ainda.</span>
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