@extends('templates.layoutpublic')

@section('title', 'Detalhes do Veículo')

@section('conteudo')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-veiculo-detalhe">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-veiculo-fotos">
                            <img src="{{ $veiculo->foto_url_1 }}" alt="Foto principal" class="card-veiculo-foto-principal">
                            @if($veiculo->foto_url_2 || $veiculo->foto_url_3)
                                <div class="card-veiculo-fotos-extras">
                                    @if($veiculo->foto_url_2)
                                        <img src="{{ $veiculo->foto_url_2 }}" alt="Foto 2" class="card-veiculo-foto-extra">
                                    @endif
                                    @if($veiculo->foto_url_3)
                                        <img src="{{ $veiculo->foto_url_3 }}" alt="Foto 3" class="card-veiculo-foto-extra">
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 card-veiculo-info">
                        <h2><strong>{{ optional($veiculo->marca)->nome }} {{ optional($veiculo->modelo)->nome }}</strong></h2>
                        <ul class="list-unstyled mb-3">
                            <li><strong>Marca:</strong> {{ optional($veiculo->marca)->nome }}</li>
                            <li><strong>Modelo:</strong> {{ optional($veiculo->modelo)->nome }}</li>
                            @if(optional($veiculo->modelo)->versao)
                                <li><strong>Versão:</strong> {{ $veiculo->modelo->versao }}</li>
                            @endif
                            @if(optional($veiculo->modelo)->ano)
                                <li><strong>Ano:</strong> {{ $veiculo->modelo->ano }}</li>
                            @endif
                            @if(optional($veiculo->modelo)->motorizacao)
                                <li><strong>Motorização:</strong> {{ $veiculo->modelo->motorizacao }}</li>
                            @endif
                            @if(optional($veiculo->modelo)->combustivel)
                                <li><strong>Combustível:</strong> {{ $veiculo->modelo->combustivel }}</li>
                            @endif
                            @if(optional($veiculo->modelo)->transmissao)
                                <li><strong>Transmissão:</strong> {{ $veiculo->modelo->transmissao }}</li>
                            @endif
                            @if(optional($veiculo->modelo)->direcao)
                                <li><strong>Direção:</strong> {{ $veiculo->modelo->direcao }}</li>
                            @endif
                            @if(optional($veiculo->modelo)->km)
                                <li><strong>KM:</strong> {{ $veiculo->modelo->km }} km</li>
                            @endif
                            <li><strong>Cidade:</strong> {{ $veiculo->cidade }}</li>
                        </ul>
                        <div class="card-veiculo-preco">Preço: R$ {{ number_format($veiculo->preco, 2, ',', '.') }}</div>
                        <div class="card-veiculo-descricao">
                            <strong>Descrição:</strong>
                            <p>{{ $veiculo->descricao }}</p>
                        </div>
                        <a href="{{ route('veiculos.index') }}" class="btn btn-outline-secondary card-veiculo-voltar">
                            <i class="fas fa-arrow-left me-1"></i> Voltar para listagem
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
