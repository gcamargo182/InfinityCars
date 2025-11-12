@extends('templates.layoutadmin')

@section('title', 'Área Administrativa - Novo Modelo')

@section('conteudo-admin')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">
                <i class="fas fa-plus me-2"></i>
                Adicionar Novo Modelo
            </h2>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Dados do Modelo
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.modelos.store') }}">
                    @csrf
                    
                  <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nome" type="text" name="nome" value="{{ old('nome') }}" required autofocus>
                                <label for="nome">Nome do Modelo</label>
                                @error('nome')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="versao" type="text" name="versao" value="{{ old('versao') }}" required autofocus>
                                <label for="versao">Versão do Modelo</label>
                                @error('versao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ano" type="text" name="ano" value="{{ old('ano') }}" required autofocus>
                                <label for="ano">Ano do Modelo</label>
                                @error('ano')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('motorizacao') is-invalid @enderror" name="motorizacao" required>
                                    <option value="">Selecione a Motorização</option>
                                    <option value="1.0" {{ old('motorizacao') == '1.0' ? 'selected' : '' }}>1.0</option>
                                    <option value="1.4" {{ old('motorizacao') == '1.4' ? 'selected' : '' }}>1.4</option>
                                    <option value="1.6" {{ old('motorizacao') == '1.6' ? 'selected' : '' }}>1.6</option>
                                    <option value="1.8" {{ old('motorizacao') == '1.8' ? 'selected' : '' }}>1.8</option>
                                    <option value="2.0" {{ old('motorizacao') == '2.0' ? 'selected' : '' }}>2.0</option>
                                </select>
                                <label for="motorizacao">Motorização</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('combustivel') is-invalid @enderror" name="combustivel" required>
                                    <option value="">Selecione o Combustível</option>
                                    <option value="Álcool" {{ old('combustivel') == 'Álcool' ? 'selected' : '' }}>Álcool</option>
                                    <option value="Gasolina" {{ old('combustivel') == 'Gasolina' ? 'selected' : '' }}>Gasolina</option>
                                    <option value="Flex (Álcool ou Gasolina)" {{ old('combustivel') == 'Flex (Álcool ou Gasolina)' ? 'selected' : '' }}>Flex (Álcool ou Gasolina)</option>
                                    <option value="Diesel" {{ old('combustivel') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                    <option value="GNV" {{ old('combustivel') == 'GNV' ? 'selected' : '' }}>GNV</option>                                    
                                    <option value="Elétrico" {{ old('combustivel') == 'Elétrico' ? 'selected' : '' }}>Elétrico</option>
                                    <option value="Híbrido (Gasolina e Elétrico)" {{ old('combustivel') == 'Híbrido (Gasolina e Elétrico)' ? 'selected' : '' }}>Híbrido (Gasolina e Elétrico)</option>
                                    <option value="Híbrido (Diesel e Elétrico)" {{ old('combustivel') == 'Híbrido (Diesel e Elétrico)' ? 'selected' : '' }}>Híbrido (Diesel e Elétrico)</option>
                                </select>
                                <label for="combustivel">Combustível</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('transmissao') is-invalid @enderror" name="transmissao" required>
                                    <option value="">Selecione a Transmissão</option>
                                    <option value="Manual" {{ old('transmissao') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="Automático" {{ old('transmissao') == 'Automático' ? 'selected' : '' }}>Automático</option>
                                </select>
                                <label for="transmissao">Transmissão</label>
                                @error('transmissao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('direcao') is-invalid @enderror" name="direcao" required>
                                    <option value="">Selecione a Direção</option>
                                    <option value="Mecânica" {{ old('direcao') == 'Mecânica' ? 'selected' : '' }}>Mecânica</option>
                                    <option value="Hidráulica" {{ old('direcao') == 'Hidráulica' ? 'selected' : '' }}>Hidráulica</option>
                                    <option value="Elétrica" {{ old('direcao') == 'Elétrica' ? 'selected' : '' }}>Elétrica</option>
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
                                    <option value="">Selecione uma Marca</option>
                                    @forelse($marcas ?? [] as $marca)
                                    <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>
                                        {{ $marca->nome }}
                                    </option>
                                    @empty
                                    <option value="" disabled>Nenhuma marca disponível</option>
                                    @endforelse
                                </select>
                                <label for="marca_id">Marca</label>
                                @error('marca_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(empty($marcas) || $marcas->count() == 0)
                                <div class="form-text text-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Nenhuma marca encontrada. <a href="{{ route('admin.marcas.create') }}">Cadastre uma marca primeiro</a>.
                                </div>
                                @endif
                            </div>
                        </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <select class="form-select @error('carroceria') is-invalid @enderror" id="carroceria" name="carroceria">
                          <option value="">Selecione a carroceria</option>
                          @forelse($tiposVeiculos ?? [] as $tipo)
                          <option value="{{ $tipo->nome }}" {{ old('carroceria') == $tipo->nome ? 'selected' : '' }}>
                            {{ $tipo->nome }}
                          </option>
                          @empty
                          <option value="" disabled>Nenhum tipo de veículo cadastrado</option>
                          @endforelse
                        </select>
                        <label for="carroceria">Carroceria</label>
                        @error('carroceria')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if(empty($tiposVeiculos) || $tiposVeiculos->count() == 0)
                        <div class="form-text text-warning">
                          <i class="fas fa-exclamation-triangle"></i>
                          Nenhum tipo de veículo encontrado. <a href="{{ route('admin.tipos.create') }}">Cadastre um tipo primeiro</a>.
                        </div>
                        @endif
                      </div>
                    </div>
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
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input class="form-control" id="km" type="text" name="km" value="{{ old('km') }}" required autofocus>
                          <label for="km">Quilometragem</label>
                          @error('km')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                    </div>
                    <div class="mb-3">
                      <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Digite uma descrição do modelo">{{ old('descricao') }}</textarea>
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
                            Salvar Modelo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection