@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Editar Tipo de Veículo')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-edit me-2"></i>
                Editar Tipo de Veículo: {{ $tipo->nome ?? 'Tipo de Veículo' }}
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
                    <i class="fas fa-car me-2"></i>
                    Dados do Tipo de Veículo
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.tipos.update', $tipo->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="carroceria" name="carroceria" required>
                                    <option value="">Selecione a Carroceria</option>
                                    <option value="Buggy" {{ (old('carroceria') ?? $tipo->nome) == 'Buggy' ? 'selected' : '' }}>Buggy</option>
                                    <option value="Conversível" {{ (old('carroceria') ?? $tipo->nome) == 'Conversível' ? 'selected' : '' }}>Conversível</option>
                                    <option value="Coupé" {{ (old('carroceria') ?? $tipo->nome) == 'Coupé' ? 'selected' : '' }}>Coupé</option>
                                    <option value="Hatch" {{ (old('carroceria') ?? $tipo->nome) == 'Hatch' ? 'selected' : '' }}>Hatch</option>
                                    <option value="Minivan" {{ (old('carroceria') ?? $tipo->nome) == 'Minivan' ? 'selected' : '' }}>Minivan</option>
                                    <option value="Motocicletas" {{ (old('carroceria') ?? $tipo->nome) == 'Motocicletas' ? 'selected' : '' }}>Motocicletas</option>
                                    <option value="Perua/SW" {{ (old('carroceria') ?? $tipo->nome) == 'Perua/SW' ? 'selected' : '' }}>Perua/SW</option>
                                    <option value="Picape" {{ (old('carroceria') ?? $tipo->nome) == 'Picape' ? 'selected' : '' }}>Picape</option>
                                    <option value="Sedã" {{ (old('carroceria') ?? $tipo->nome) == 'Sedã' ? 'selected' : '' }}>Sedã</option>
                                    <option value="SUV" {{ (old('carroceria') ?? $tipo->nome) == 'SUV' ? 'selected' : '' }}>SUV</option>
                                    <option value="Van/Utilitário/Furgão" {{ (old('carroceria') ?? $tipo->nome) == 'Van/Utilitário/Furgão' ? 'selected' : '' }}>Van/Utilitário/Furgão</option>
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
                                    <option value="Ativo" {{ (old('status') ?? $tipo->status) == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                    <option value="Inativo" {{ (old('status') ?? $tipo->status) == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <label for="status">Status</label>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="descricao" name="descricao" style="height: 120px;" placeholder="Descrição do tipo de veículo">{{ old('descricao') ?? $tipo->descricao }}</textarea>
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
                            Atualizar Tipo de Veículo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection