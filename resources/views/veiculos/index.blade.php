@extends('templates.layoutpublic')

@section('title', 'Infinity Cars')

@section('conteudo')
    <h2 class="main-title">Nossos Veículos</h2>
    @if($veiculos->count() > 0)
        <div class="row justify-content-center">
            @foreach($veiculos as $veiculo)
                <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                    <div class="bg-white rounded shadow-sm overflow-hidden hover:shadow-md transition-shadow w-100" style="min-height: 400px; max-width: 360px; margin: auto; display: flex; flex-direction: column;">
                        <div style="width:100%;height:200px;display:flex;align-items:center;justify-content:center;background:#f8f8f8;">
                            <img src="{{ $veiculo->foto_url_1 }}" alt="{{ optional($veiculo->marca)->nome }} {{ optional($veiculo->modelo)->nome }}" style="max-width:100%;max-height:190px;object-fit:contain;">
                        </div>
                        <div class="p-3 flex-fill text-center">
                            <h3 class="text-lg mb-1 truncate">
                                <strong style="font-weight:bold;">{{ optional($veiculo->marca)->nome }} {{ optional($veiculo->modelo)->nome }}</strong>
                            </h3>
                            <div class="space-y-1 text-gray-600 mb-2 text-sm">
                                <p><strong>Tipo:</strong> {{ optional($veiculo->tipoVeiculo)->nome }}</p>
                                <p><strong>Cor:</strong> {{ optional($veiculo->cor)->nome }}</p>
                                <p><strong>Placa:</strong> {{ $veiculo->placa }}</p>
                            </div>
                            <div class="flex justify-center items-center mb-2">
                                <span class="text-base font-bold text-green-600">
                                    R$ {{ number_format($veiculo->preco, 2, ',', '.') }}
                                </span>
                            </div>
                            <a href="{{ route('veiculos.show', $veiculo->id) }}" class="btn btn-sm btn-primary w-100" style="display:block;text-align:center;">
                                <i class="fas fa-info-circle me-1"></i> Ver Mais
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <h3 class="main-text">Nenhum veículo disponível no momento</h3>
        </div>
    @endif
@endsection