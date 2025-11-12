@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Veículos')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-car me-2"></i>
                Gestão de Veículos
            </h2>
            <a href="{{ route('admin.veiculos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Novo Veículo
            </a>
        </div>

        <!-- Card de Estatísticas -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Total de Veículos</h6>
                                <h2>{{ $totalVeiculos }}</h2>
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
                                <h6 class="card-title">Marcas</h6>
                                <h2>{{ $totalMarcas }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-building fa-2x"></i>
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
                                <h6 class="card-title">Disponíveis</h6>
                                <h2>{{ $totalVeiculosDisponiveis }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Vendidos</h6>
                                <h2>{{ $totalVeiculosVendidos }}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-handshake fa-2x"></i>
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
                    Lista de Veículos
                </h5>
            </div>
            <div class="card-body">
                <!-- Filtros -->
                <form method="GET" action="{{ route('admin.veiculos.index') }}">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="busca" value="{{ request('busca') }}" placeholder="Buscar por modelo...">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="marca_id">
                                <option value="">Todas as marcas</option>
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}" {{ request('marca_id') == $marca->id ? 'selected' : '' }}>{{ $marca->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="tipo_veiculo_id">
                                <option value="">Todos os tipos</option>
                                @foreach($tiposVeiculos as $tipo)
                                    <option value="{{ $tipo->id }}" {{ request('tipo_veiculo_id') == $tipo->id ? 'selected' : '' }}>{{ $tipo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" name="status">
                                <option value="">Todos os status</option>
                                <option value="Ativo" {{ request('status') == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="Inativo" {{ request('status') == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Filtrar
                            </button>
                            @if(request('busca') || request('marca_id') || request('tipo_veiculo_id') || request('status'))
                            <a href="{{ route('admin.veiculos.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                                <i class="fas fa-eraser"></i> Limpar
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
                                <th>Placa</th>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>Tipo</th>
                                <th>Cor</th>
                                <th>Cidade</th>
                                <th>Preço</th>
                                <th>Status</th>
                                <th>Data Criação</th>
                                <th>Data Atualização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($veiculos as $veiculo)
                            <tr>
                                <td>{{ $veiculo->id }}</td>
                                <td>{{ $veiculo->placa }}</td>
                                <td>{{ optional($veiculo->modelo)->nome }}</td>
                                <td>{{ optional($veiculo->marca)->nome }}</td>
                                <td>{{ optional($veiculo->tipoVeiculo)->nome }}</td>
                                <td>{{ optional($veiculo->cor)->nome }}</td>
                                <td>{{ $veiculo->cidade }}</td>
                                <td>R$ {{ number_format($veiculo->preco, 2, ',', '.') }}</td>
                                <td>
                                    @if($veiculo->status === 'Ativo')
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-danger">Inativo</span>
                                    @endif
                                </td>
                                <td>{{ $veiculo->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $veiculo->updated_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.veiculos.edit', $veiculo->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.veiculos.destroy', $veiculo->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este veículo?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center py-5">
                                    <span class="text-muted">Nenhum veículo cadastrado ainda.</span>
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