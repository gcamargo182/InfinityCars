<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Página inicial pública com lista de marcas
        $marcas = collect([]); // Collection vazia, depois será substituída por dados do banco
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Área administrativa - lista de marcas
     */
    public function adminIndex(Request $request)
    {
        // Iniciar a query
        $query = Marca::query();

        // Filtro por busca (nome)
        if ($request->filled('busca')) {
            $query->where('nome', 'like', '%' . $request->busca . '%');
        }

        // Filtro por marcas
        if ($request->filled('marca')) {
            $query->where('marca', $request->marca);
        }

        // Filtro por categorias
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // Buscar os resultados ordenados
        $marcas = $query->latest()->get();

        // Buscar marcas únicas cadastradas
        $marcasDisponiveis = Marca::select('nome')
            ->distinct()
            ->whereNotNull('nome')
            ->orderBy('nome')
            ->pluck('nome');
        
        // Buscar categorias únicos cadastrados
        $categoriasDisponiveis = Marca::select('categoria')
            ->distinct()
            ->whereNotNull('categoria')
            ->orderBy('categoria')
            ->pluck('categoria');

        return view('admin.marcas.index', compact('marcas', 'marcasDisponiveis', 'categoriasDisponiveis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'origem' => 'nullable|in:Nacional,Importado',
            'categoria' => 'nullable|in:Aplicativos,Esportivos,Família,Grandes,Híbridos,Importados,Luxo,Populares',
            'pais_origem' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'required|in:Ativo,Inativo',
        ]);

        $marca = new Marca();
        $marca->nome = $validatedData['nome'];
        $marca->origem = $validatedData['origem'];
        $marca->categoria = $validatedData['categoria'];
        $marca->pais_origem = $validatedData['pais_origem'];
        $marca->descricao = $validatedData['descricao'];
        $marca->status = $validatedData['status'];
        $marca->save();

        return redirect()->route('admin.marcas.index')->with('success', 'Marca criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Página de detalhes da marca
        return view('marcas.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marca = Marca::findOrFail($id);
        return view('admin.marcas.edit', compact('marca'));
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
            'origem' => 'nullable|in:Nacional,Importado',
            'categoria' => 'nullable|in:Aplicativos,Esportivos,Família,Grandes,Híbridos,Importados,Luxo,Populares',
            'pais_origem' => 'nullable|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'status' => 'required|in:Ativo,Inativo'
        ]);

        $marca = Marca::findOrFail($id);
        
        $marca->update([
            'nome' => $request->nome,
            'origem' => $request->origem,
            'categoria' => $request->categoria,
            'pais_origem' => $request->pais_origem,
            'descricao' => $request->descricao,
            'status' => $request->status
        ]);

        return redirect()->route('admin.marcas.index')->with('success', 'Marca atualizada com sucesso!');
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
            $marca = Marca::findOrFail($id);
            $nome = $marca->nome;
            $marca->delete();

            return redirect()->route('admin.marcas.index')
                ->with('success', 'Marca "' . $nome . '" removida com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.marcas.index')
                ->with('error', 'Erro ao remover marca: ' . $e->getMessage());
        }
    }
}
