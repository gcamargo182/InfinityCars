@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Cadastrar Veículo')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-plus me-2"></i>
                Cadastrar Novo Veículo
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
                    <i class="fas fa-car me-2"></i>
                    Dados do Veículo
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.veiculos.store') }}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('marca_id') is-invalid @enderror" id="marca_id" name="marca_id" required>
                                    <option value="">Selecione a Marca</option>
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>{{ $marca->nome }}</option>
                                    @endforeach
                                </select>
                                <label for="marca_id">Marca</label>
                                @error('marca_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('modelo_id') is-invalid @enderror" id="modelo_id" name="modelo_id" required>
                                    <option value="">Selecione o Modelo</option>
                                    @foreach($modelos as $modelo)
                                        <option value="{{ $modelo->id }}" {{ old('modelo_id') == $modelo->id ? 'selected' : '' }}>{{ $modelo->nome }}</option>
                                    @endforeach
                                </select>
                                <label for="modelo_id">Modelo</label>
                                @error('modelo_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('tipo_veiculo_id') is-invalid @enderror" id="tipo_veiculo_id" name="tipo_veiculo_id" required>
                                    <option value="">Selecione o Tipo</option>
                                    @foreach($tiposVeiculos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('tipo_veiculo_id') == $tipo->id ? 'selected' : '' }}>{{ $tipo->nome }}</option>
                                    @endforeach
                                </select>
                                <label for="tipo_veiculo_id">Tipo de Veículo</label>
                                @error('tipo_veiculo_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('cor_id') is-invalid @enderror" id="cor_id" name="cor_id" required>
                                    <option value="">Selecione a Cor</option>
                                    @foreach($cores as $cor)
                                        <option value="{{ $cor->id }}" {{ old('cor_id') == $cor->id ? 'selected' : '' }}>{{ $cor->nome }}</option>
                                    @endforeach
                                </select>
                                <label for="cor_id">Cor</label>
                                @error('cor_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('placa') is-invalid @enderror" id="placa" name="placa" placeholder="Placa" value="{{ old('placa') }}" required>
                                <label for="placa">Placa</label>
                                @error('placa')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('cidade') is-invalid @enderror" id="cidade" name="cidade" placeholder="Cidade" value="{{ old('cidade') }}">
                                <label for="cidade">Cidade</label>
                                @error('cidade')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control @error('preco') is-invalid @enderror" id="preco" name="preco" placeholder="Preço" value="{{ old('preco') }}" required>
                                <label for="preco">Preço (R$)</label>
                                @error('preco')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="">Selecione o Status</option>
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

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="url" class="form-control @error('foto_url_1') is-invalid @enderror" id="foto_url_1" name="foto_url_1" placeholder="URL da Foto 1" value="{{ old('foto_url_1') }}">
                                <label for="foto_url_1">URL da Foto 1</label>
                                @error('foto_url_1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="url" class="form-control @error('foto_url_2') is-invalid @enderror" id="foto_url_2" name="foto_url_2" placeholder="URL da Foto 2" value="{{ old('foto_url_2') }}">
                                <label for="foto_url_2">URL da Foto 2</label>
                                @error('foto_url_2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="url" class="form-control @error('foto_url_3') is-invalid @enderror" id="foto_url_3" name="foto_url_3" placeholder="URL da Foto 3" value="{{ old('foto_url_3') }}">
                                <label for="foto_url_3">URL da Foto 3</label>
                                @error('foto_url_3')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="4" placeholder="Descrição do veículo">{{ old('descricao') }}</textarea>
                                @error('descricao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.veiculos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Cadastrar Veículo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection