@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Editar Modelo')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-edit me-2"></i>
                Editar Modelo: {{ $modelo->nome ?? 'Modelo' }}
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
                    <i class="fas fa-clipboard-list me-2"></i>
                    Dados do Modelo
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.modelos.update', $modelo->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Modelo" value="{{ old('nome') ?? $modelo->nome }}" required>
                                <label for="nome">Nome do Modelo</label>
                                @error('nome')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>                    
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="versao" name="versao" placeholder="Versão do Modelo" value="{{ old('versao') ?? $modelo->versao }}" required>
                                <label for="versao">Versão do Modelo</label>
                                @error('versao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="ano" name="ano" placeholder="Ano do Modelo" value="{{ old('ano') ?? $modelo->ano }}" required>
                                <label for="ano">Ano do Modelo</label>
                                @error('ano')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="motorizacao" name="motorizacao" required>
                                    <option value="">Selecione a Motorização</option>
                                    <option value="1.0" {{ (old('motorizacao') ?? $modelo->motorizacao) == '1.0' ? 'selected' : '' }}>1.0</option>
                                    <option value="1.4" {{ (old('motorizacao') ?? $modelo->motorizacao) == '1.4' ? 'selected' : '' }}>1.4</option>
                                    <option value="1.6" {{ (old('motorizacao') ?? $modelo->motorizacao) == '1.6' ? 'selected' : '' }}>1.6</option>
                                    <option value="1.8" {{ (old('motorizacao') ?? $modelo->motorizacao) == '1.8' ? 'selected' : '' }}>1.8</option>
                                    <option value="2.0" {{ (old('motorizacao') ?? $modelo->motorizacao) == '2.0' ? 'selected' : '' }}>2.0</option>
                                </select>
                                <label for="motorizacao">Motorização</label>
                                @error('motorizacao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>                        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="combustivel" name="combustivel" required>
                                    <option value="">Selecione o Combustível</option>
                                    <option value="Álcool" {{ (old('combustivel') ?? $modelo->combustivel) == 'Álcool' ? 'selected' : '' }}>Álcool</option>
                                    <option value="Gasolina" {{ (old('combustivel') ?? $modelo->combustivel) == 'Gasolina' ? 'selected' : '' }}>Gasolina</option>
                                    <option value="Flex (Álcool ou Gasolina)" {{ (old('combustivel') ?? $modelo->combustivel) == 'Flex (Álcool ou Gasolina)' ? 'selected' : '' }}>Flex (Álcool ou Gasolina)</option>
                                    <option value="Diesel" {{ (old('combustivel') ?? $modelo->combustivel) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                    <option value="GNV" {{ (old('combustivel') ?? $modelo->combustivel) == 'GNV' ? 'selected' : '' }}>GNV</option>
                                    <option value="Elétrico" {{ (old('combustivel') ?? $modelo->combustivel) == 'Elétrico' ? 'selected' : '' }}>Elétrico</option>
                                    <option value="Híbrido (Gasolina e Elétrico)" {{ (old('combustivel') ?? $modelo->combustivel) == 'Híbrido (Gasolina e Elétrico)' ? 'selected' : '' }}>Híbrido (Gasolina e Elétrico)</option>
                                    <option value="Híbrido (Diesel e Elétrico)" {{ (old('combustivel') ?? $modelo->combustivel) == 'Híbrido (Diesel e Elétrico)' ? 'selected' : '' }}>Híbrido (Diesel e Elétrico)</option>
                                </select>
                                <label for="combustivel">Combustível</label>
                                @error('combustivel')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="transmissao" name="transmissao" required>
                                    <option value="">Selecione a Transmissão</option>
                                    <option value="Manual" {{ (old('transmissao') ?? $modelo->transmissao) == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="Automático" {{ (old('transmissao') ?? $modelo->transmissao) == 'Automático' ? 'selected' : '' }}>Automático</option>
                                    </select>
                                <label for="transmissao">Transmissão</label>
                                @error('transmissao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="direcao" name="direcao" required>
                                    <option value="">Selecione a Direção</option>
                                    <option value="Mecânica" {{ (old('direcao') ?? $modelo->direcao) == 'Mecânica' ? 'selected' : '' }}>Mecânica</option>
                                    <option value="Hidráulica" {{ (old('direcao') ?? $modelo->direcao) == 'Hidráulica' ? 'selected' : '' }}>Hidráulica</option>
                                    <option value="Elétrica" {{ (old('direcao') ?? $modelo->direcao) == 'Elétrica' ? 'selected' : '' }}>Elétrica</option>
                                  </select>
                                <label for="direcao">Direção</label>
                                @error('direcao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('marca_id') is-invalid @enderror" name="marca_id" required>
                                    <option value="">Selecione a Marca</option>
                                    @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}" {{ (old('marca_id') ?? $modelo->marca_id) == $marca->id ? 'selected' : '' }}>{{ $marca->nome }}</option>
                                    @endforeach
                                </select>
                                <label for="marca_id">Marca</label>
                                @error('marca_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('carroceria') is-invalid @enderror" name="carroceria" required>
                                    <option value="">Selecione a Carroceria</option>
                                    @foreach($tiposVeiculos as $tipo)
                                    <option value="{{ $tipo->nome }}" {{ (old('carroceria') ?? optional($modelo->tipoVeiculo)->nome) == $tipo->nome ? 'selected' : '' }}>{{ $tipo->nome }}</option>
                                    @endforeach
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
                                    <option value="Ativo" {{ (old('status') ?? $modelo->status) == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                    <option value="Inativo" {{ (old('status') ?? $modelo->status) == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <label for="status">Status</label>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="km" type="text" name="km" value="{{ old('km') ?? $modelo->km }}" required>
                                <label for="km">Quilometragem</label>
                                @error('km')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="descricao" name="descricao" style="height: 120px;" placeholder="Descrição do modelo">{{ old('descricao') ?? $modelo->descricao }}</textarea>
                            @error('descricao')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.modelos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Atualizar Modelo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection