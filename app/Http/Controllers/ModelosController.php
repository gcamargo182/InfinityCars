<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\TipoVeiculo;

class ModelosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Página inicial pública com lista de modelos
        $modelos = collect([]); // Collection vazia, depois será substituída por dados do banco
        return view('modelos.index', compact('modelos'));
    }

    /**
     * Área administrativa - lista de modelos
     */
    public function adminIndex(Request $request)
    {
        // Iniciar a query
        $query = Modelo::with('marca');

        // Filtro por nome
        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

        // Filtro por versão
        if ($request->filled('versao')) {
            $query->where('versao', 'like', '%' . $request->versao . '%');
        }

        // Filtro por motorização
        if ($request->filled('motorizacao')) {
            $query->where('motorizacao', $request->motorizacao);
        }

        // Filtro por transmissão
        if ($request->filled('transmissao')) {
            $query->where('transmissao', $request->transmissao);
        }

        // Filtro por direção
        if ($request->filled('direcao')) {
            $query->where('direcao', $request->direcao);
        }

        // Buscar os resultados ordenados
        $modelos = $query->latest()->get();

        // Buscar motorizações únicas cadastradas
        $motorizacoesDisponiveis = Modelo::select('motorizacao')
            ->distinct()
            ->whereNotNull('motorizacao')
            ->orderBy('motorizacao')
            ->pluck('motorizacao');
        
        // Buscar transmissões únicas cadastradas
        $transmissoesDisponiveis = Modelo::select('transmissao')
            ->distinct()
            ->whereNotNull('transmissao')
            ->orderBy('transmissao')
            ->pluck('transmissao');
        
        // Buscar direções únicas cadastradas
        $direcoesDisponiveis = Modelo::select('direcao')
            ->distinct()
            ->whereNotNull('direcao')
            ->orderBy('direcao')
            ->pluck('direcao');

        return view('admin.modelos.index', compact('modelos', 'motorizacoesDisponiveis', 'transmissoesDisponiveis', 'direcoesDisponiveis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::all();
        $tiposVeiculos = TipoVeiculo::where('status', 'ativo')->orderBy('nome')->get();
        return view('admin.modelos.create', compact('marcas', 'tiposVeiculos'));
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
            // Debug: Verificar dados recebidos
            \Log::info('Dados recebidos no formulário:', $request->all());
            
            // Validação dos dados
            $validatedData = $request->validate([
                'nome' => 'required|string|max:255',
                'marca_id' => 'required|exists:marcas,id',
                'ano' => 'nullable|string',
                'categoria' => 'nullable|string',
                'descricao' => 'nullable|string',
                'versao' => 'nullable|string',
                'motorizacao' => 'nullable|string',
                'combustivel' => 'nullable|string',
                'transmissao' => 'nullable|string',
                'direcao' => 'nullable|string',
                'km' => 'nullable|string',
                'carroceria' => 'nullable|string',
                'status' => 'required|in:Ativo,Inativo',
            ]);

            \Log::info('Dados validados:', $validatedData);

            // Buscar o tipo_veiculo_id baseado no nome da carroceria
            if (!empty($validatedData['carroceria'])) {
                $tipoVeiculo = TipoVeiculo::where('nome', $validatedData['carroceria'])->first();
                if ($tipoVeiculo) {
                    $validatedData['tipo_veiculo_id'] = $tipoVeiculo->id;
                }
            }

            // Remover o campo carroceria antes de salvar (não existe na tabela)
            unset($validatedData['carroceria']);

            // Salvar no banco de dados
            $modelo = Modelo::create($validatedData);
            
            \Log::info('Modelo criado com sucesso:', ['id' => $modelo->id, 'nome' => $modelo->nome]);

            return redirect()->route('admin.modelos.index')
                ->with('success', 'Modelo "' . $modelo->nome . '" cadastrado com sucesso!');
                
        } catch (\Exception $e) {
            \Log::error('Erro ao salvar modelo:', ['erro' => $e->getMessage()]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar modelo: ' . $e->getMessage());
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
        // Página de detalhes do modelo
        return view('modelos.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelo = Modelo::findOrFail($id);
        $marcas = Marca::all();
        $tiposVeiculos = TipoVeiculo::where('status', 'ativo')->orderBy('nome')->get();
        return view('admin.modelos.edit', compact('modelo', 'marcas', 'tiposVeiculos'));
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
            'marca_id' => 'required|exists:marcas,id',
            'ano' => 'nullable|string',
            'categoria' => 'nullable|string',
            'descricao' => 'nullable|string',
            'versao' => 'nullable|string',
            'motorizacao' => 'nullable|string',
            'combustivel' => 'nullable|string',
            'transmissao' => 'nullable|string',
            'direcao' => 'nullable|string',
            'km' => 'nullable|string',
            'carroceria' => 'nullable|string',
            'status' => 'required|in:Ativo,Inativo',
        ]);

        $modelo = Modelo::findOrFail($id);
        
        // Buscar o tipo_veiculo_id baseado no nome da carroceria
        $tipo_veiculo_id = null;
        if (!empty($request->carroceria)) {
            $tipoVeiculo = TipoVeiculo::where('nome', $request->carroceria)->first();
            if ($tipoVeiculo) {
                $tipo_veiculo_id = $tipoVeiculo->id;
            }
        }
        
        $modelo->update([
            'nome' => $request->nome,
            'marca_id' => $request->marca_id,
            'ano' => $request->ano,
            'categoria' => $request->categoria,
            'descricao' => $request->descricao,
            'versao' => $request->versao,
            'motorizacao' => $request->motorizacao,
            'combustivel' => $request->combustivel,
            'transmissao' => $request->transmissao,
            'direcao' => $request->direcao,
            'km' => $request->km,
            'tipo_veiculo_id' => $tipo_veiculo_id,
            'status' => $request->status
        ]);

        return redirect()->route('admin.modelos.index')->with('success', 'Modelo atualizado com sucesso!');
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
            $modelo = Modelo::findOrFail($id);
            $nome = $modelo->nome;
            $modelo->delete();

            return redirect()->route('admin.modelos.index')
                ->with('success', 'Modelo "' . $nome . '" removido com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.modelos.index')
                ->with('error', 'Erro ao remover modelo: ' . $e->getMessage());
        }
    }
}
