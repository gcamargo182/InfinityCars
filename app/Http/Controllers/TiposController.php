<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoVeiculo;
use App\Models\Marca;

class TiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Página inicial pública com lista de tipos
        $tipos = collect([]); // Collection vazia, depois será substituída por dados do banco
        return view('veiculos.index', compact('veiculos'));
    }

    /**
     * Área administrativa - lista de tipos
     */
    public function adminIndex(Request $request)
    {
        // Iniciar a query
        $query = TipoVeiculo::query();

        // Filtro por busca (nome)
        if ($request->filled('busca')) {
            $query->where('nome', 'like', '%' . $request->busca . '%');
        }

        // Filtro por carroceria
        if ($request->filled('carroceria')) {
            $query->where('nome', $request->carroceria);
        }

        // Buscar os resultados ordenados
        $tipos = $query->latest()->get();
        
        // Buscar todas as carrocerias cadastradas (valores únicos)
        $carrocerias = TipoVeiculo::select('nome')
            ->distinct()
            ->orderBy('nome')
            ->pluck('nome');
        
        return view('admin.tipos.index', compact('tipos', 'carrocerias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Buscar todos os tipos existentes para popular o select
        $tiposExistentes = TipoVeiculo::where('status', 'ativo')->orderBy('nome')->get();
        return view('admin.tipos.create', compact('tiposExistentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validação dos dados
            $validatedData = $request->validate([
                'carroceria' => 'required|string|max:255',
                'descricao' => 'nullable|string',
                'status' => 'required|string|in:Ativo,Inativo'
            ]);

            // O nome será o mesmo que carroceria
            $data = [
                'nome' => $validatedData['carroceria'],
                'descricao' => $validatedData['descricao'] ?? null,
                'status' => $validatedData['status']
            ];

            // Salvar no banco de dados
            $tipo = TipoVeiculo::create($data);

            return redirect()->route('admin.tipos.index')
                ->with('success', 'Tipo de veículo "' . $tipo->nome . '" cadastrado com sucesso!');
                
        } catch (\Exception $e) {
            \Log::error('Erro ao salvar tipo de veículo:', ['erro' => $e->getMessage()]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar tipo: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Página de detalhes do tipo
        return view('tipos.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo = TipoVeiculo::findOrFail($id);
        return view('admin.tipos.edit', compact('tipo'));
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
        $request->validate([
            'carroceria' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'required|in:Ativo,Inativo',
        ]);

        $tipo = TipoVeiculo::findOrFail($id);
        
        $tipo->update([
            'nome' => $request->carroceria,
            'descricao' => $request->descricao,
            'status' => $request->status
        ]);

        return redirect()->route('admin.tipos.index')->with('success', 'Tipo atualizado com sucesso!');
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
            $tipo = TipoVeiculo::findOrFail($id);
            $nome = $tipo->nome;
            $tipo->delete();

            return redirect()->route('admin.tipos.index')
                ->with('success', 'Tipo "' . $nome . '" removido com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.tipos.index')
                ->with('error', 'Erro ao remover tipo: ' . $e->getMessage());
        }
    }
}
