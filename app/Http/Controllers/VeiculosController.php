<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Cor;
use App\Models\TipoVeiculo;
use App\Models\Veiculo;

class VeiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $veiculos = Veiculo::with(['marca', 'modelo', 'tipoVeiculo', 'cor'])
            ->where('status', 'Ativo')
            ->orderByDesc('created_at')
            ->get();
        return view('veiculos.index', compact('veiculos'));
    }

    /**
     * Área administrativa - lista de veículos
     */
    public function adminIndex(Request $request)
    {
        $query = Veiculo::query();

        // Filtro por modelo (nome)
        if ($request->filled('busca')) {
            $query->whereHas('modelo', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->busca . '%');
            });
        }
        // Filtro por marca
        if ($request->filled('marca_id')) {
            $query->where('marca_id', $request->marca_id);
        }
        // Filtro por tipo de veículo
        if ($request->filled('tipo_veiculo_id')) {
            $query->where('tipo_veiculo_id', $request->tipo_veiculo_id);
        }
        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $veiculos = $query->with(['marca', 'modelo', 'tipoVeiculo', 'cor'])->orderByDesc('created_at')->get();
        $marcas = Marca::all();
        $tiposVeiculos = TipoVeiculo::all();

        $totalVeiculos = Veiculo::count();
        $totalMarcas = Marca::count();
        $totalVeiculosDisponiveis = Veiculo::where('status', 'Ativo')->count();
        $totalVeiculosVendidos = Veiculo::where('status', 'Inativo')->count();

        return view('admin.veiculos.index', compact(
            'veiculos', 'marcas', 'tiposVeiculos',
            'totalVeiculos', 'totalMarcas', 'totalVeiculosDisponiveis', 'totalVeiculosVendidos'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $cores = Cor::all();
        $tiposVeiculos = TipoVeiculo::all();
        
        return view('admin.veiculos.create', compact('marcas', 'modelos', 'cores', 'tiposVeiculos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'marca_id' => 'required|exists:marcas,id',
            'modelo_id' => 'required|exists:modelos,id',
            'tipo_veiculo_id' => 'required|exists:tipos_veiculos,id',
            'cor_id' => 'required|exists:cores,id',
            'placa' => 'required|unique:veiculos,placa',
            'cidade' => 'nullable|string|max:255',
            'preco' => 'required|numeric|min:0',
            'status' => 'required|in:Ativo,Inativo',
            'foto_url_1' => 'nullable|url',
            'foto_url_2' => 'nullable|url',
            'foto_url_3' => 'nullable|url',
            'descricao' => 'nullable|string',
        ]);

        Veiculo::create($request->all());

        return redirect()->route('admin.veiculos.index')->with('success', 'Veículo cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veiculo = Veiculo::with(['marca', 'modelo', 'tipoVeiculo', 'cor'])->findOrFail($id);
        return view('veiculos.show', compact('veiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $veiculo = Veiculo::findOrFail($id);
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $cores = Cor::all();
        $tiposVeiculos = TipoVeiculo::all();
        return view('admin.veiculos.edit', compact('veiculo', 'marcas', 'modelos', 'cores', 'tiposVeiculos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $veiculo = Veiculo::findOrFail($id);
        $request->validate([
            'marca_id' => 'required|exists:marcas,id',
            'modelo_id' => 'required|exists:modelos,id',
            'tipo_veiculo_id' => 'required|exists:tipos_veiculos,id',
            'cor_id' => 'required|exists:cores,id',
            'placa' => 'required|unique:veiculos,placa,' . $veiculo->id,
            'cidade' => 'nullable|string|max:255',
            'preco' => 'required|numeric|min:0',
            'status' => 'required|in:Ativo,Inativo',
            'foto_url_1' => 'nullable|url',
            'foto_url_2' => 'nullable|url',
            'foto_url_3' => 'nullable|url',
            'descricao' => 'nullable|string',
        ], [
            'required' => 'Este campo é obrigatório.',
            'unique' => 'Este valor já está cadastrado.',
            'exists' => 'Selecione uma opção válida.',
            'numeric' => 'Informe um valor numérico.',
            'in' => 'Selecione uma opção válida.',
            'url' => 'Informe uma URL válida.',
        ]);

        $veiculo->update($request->all());

        return redirect()->route('admin.veiculos.index')
            ->with('success', 'Veículo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $veiculo = Veiculo::findOrFail($id);
            $nome = $veiculo->nome;
            $veiculo->delete();

            return redirect()->route('admin.veiculos.index')
                ->with('success', 'Veículo "' . $nome . '" removido com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.veiculos.index')
                ->with('error', 'Erro ao remover veículo: ' . $e->getMessage());
        }
    }
}
