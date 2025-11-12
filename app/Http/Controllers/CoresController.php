<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cor;

class CoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Página inicial pública com lista de cores
        $cores = collect([]); // Collection vazia, depois será substituída por dados do banco
        return view('cores.index', compact('cores'));
    }

    /**
     * Área administrativa - lista de cores
     */
    public function adminIndex(Request $request)
    {
        // Iniciar a query
        $query = Cor::query();

        // Filtro por busca (nome)
        if ($request->filled('busca')) {
            $query->where('nome', 'like', '%' . $request->busca . '%');
        }

        // Filtro por cor
        if ($request->filled('cor')) {
            $query->where('nome', $request->cor);
        }

        // Filtro por tons
        if ($request->filled('tons')) {
            $query->where('tons', $request->tons);
        }

        // Buscar os resultados ordenados
        $cores = $query->latest()->get();

        // Buscar cores únicas cadastradas
        $coresDisponiveis = Cor::select('nome')
            ->distinct()
            ->whereNotNull('nome')
            ->orderBy('nome')
            ->pluck('nome');
        
        // Buscar tons únicos cadastrados
        $tonsDisponiveis = Cor::select('tons')
            ->distinct()
            ->whereNotNull('tons')
            ->orderBy('tons')
            ->pluck('tons');
        
        return view('admin.cores.index', compact('cores', 'coresDisponiveis', 'tonsDisponiveis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cores.create');
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
                'cor' => 'required|string|max:255',
                'tons' => 'required|string|max:255',
                'descricao' => 'nullable|string',
                'status' => 'required|string|in:Ativo,Inativo',
            ]);

            // Preparar dados para salvar
            $data = [
                'nome' => $validatedData['cor'],
                'tons' => $validatedData['tons'],
                'descricao' => $validatedData['descricao'] ?? null,
                'status' => $validatedData['status']
            ];

            // Salvar no banco de dados
            $cor = Cor::create($data);

            return redirect()->route('admin.cores.index')
                ->with('success', 'Cor "' . $cor->nome . '" cadastrada com sucesso!');
                
        } catch (\Exception $e) {
            \Log::error('Erro ao salvar cor:', ['erro' => $e->getMessage()]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar cor: ' . $e->getMessage());
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
        // Página de detalhes da cor
        return view('cores.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cor = Cor::findOrFail($id);
        return view('admin.cores.edit', compact('cor'));
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
            'nome' => 'required|string|max:255',
            'tons' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'status' => 'required|in:Ativo,Inativo'
        ]);

        $cor = Cor::findOrFail($id);
        
        $cor->update([
            'nome' => $request->nome,
            'tons' => $request->tons,
            'descricao' => $request->descricao,
            'status' => $request->status
        ]);

        return redirect()->route('admin.cores.index')->with('success', 'Cor atualizada com sucesso!');
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
            $cor = Cor::findOrFail($id);
            $nome = $cor->nome;
            $cor->delete();

            return redirect()->route('admin.cores.index')
                ->with('success', 'Cor "' . $nome . '" removida com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.cores.index')
                ->with('error', 'Erro ao remover cor: ' . $e->getMessage());
        }
    }
}
