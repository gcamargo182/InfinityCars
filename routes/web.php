<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VeiculosController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ModelosController;
use App\Http\Controllers\CoresController;

Route::get('/', function () {
    return view('veiculos.index');
});

Route::get('/dashboard', function () {
    // Garantir que a session seja criada ao acessar o dashboard
    if (Auth::check() && !session()->has('usuario_logado')) {
        $user = Auth::user();
        session()->put('usuario_logado', [
            'id' => $user->id,
            'nome' => $user->name,
            'email' => $user->email
        ]);
        \Log::info('✅ Session criada no dashboard para: ' . $user->name);
    }
    return view('dashboard');
})->middleware(['auth'])->name('home');

// Rota para ir do REGISTER para a LOGIN
Route::get('/usuarios/register', function () {
    return view('auth.login');
})->name('login');


// Route::get('/usuarios/register',function(){

//     return view('usuarios.register');

// })->name('usuarios.register');

require __DIR__.'/auth.php';

Route::get('/', [VeiculosController::class, 'index'])->name('veiculos.index');
Route::get('/veiculo/{veiculo}', [VeiculosController::class, 'show'])->name('veiculos.show');

// Área administrativa (após login)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/veiculos', [VeiculosController::class, 'adminIndex'])->name('veiculos.index');
    Route::get('/veiculos/create', [VeiculosController::class, 'create'])->name('veiculos.create');
    Route::get('/veiculos/{id}/edit', [VeiculosController::class, 'edit'])->name('veiculos.edit');
    Route::post('/veiculos', [VeiculosController::class, 'store'])->name('veiculos.store');
    Route::put('/veiculos/{id}', [VeiculosController::class, 'update'])->name('veiculos.update');
    Route::delete('/veiculos/{veiculo}', [VeiculosController::class, 'destroy'])->name('veiculos.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/tipos', [TiposController::class, 'adminIndex'])->name('tipos.index');
    Route::get('/tipos/create', [TiposController::class, 'create'])->name('tipos.create');
    Route::get('/tipos/{id}/edit', [TiposController::class, 'edit'])->name('tipos.edit');
    Route::post('/tipos', [TiposController::class, 'store'])->name('tipos.store');
    Route::put('/tipos/{id}', [TiposController::class, 'update'])->name('tipos.update');
    Route::delete('/tipos/{tipo}', [TiposController::class, 'destroy'])->name('tipos.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/marcas', [MarcasController::class, 'adminIndex'])->name('marcas.index');
    Route::get('/marcas/create', [MarcasController::class, 'create'])->name('marcas.create');
    Route::get('/marcas/{id}/edit', [MarcasController::class, 'edit'])->name('marcas.edit');
    Route::post('/marcas', [MarcasController::class, 'store'])->name('marcas.store');
    Route::put('/marcas/{id}', [MarcasController::class, 'update'])->name('marcas.update');
    Route::delete('/marcas/{marca}', [MarcasController::class, 'destroy'])->name('marcas.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/modelos', [ModelosController::class, 'adminIndex'])->name('modelos.index');
    Route::get('/modelos/create', [ModelosController::class, 'create'])->name('modelos.create');
    Route::get('/modelos/{id}/edit', [ModelosController::class, 'edit'])->name('modelos.edit');
    Route::post('/modelos', [ModelosController::class, 'store'])->name('modelos.store');
    Route::put('/modelos/{id}', [ModelosController::class, 'update'])->name('modelos.update');
    Route::delete('/modelos/{modelo}', [ModelosController::class, 'destroy'])->name('modelos.destroy');
    
    // Rota de teste CSRF (remover depois)
    Route::get('/test-csrf', function() {
        $marcas = \App\Models\Marcas::all();
        return view('test-csrf', compact('marcas'));
    })->name('test.csrf');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/cores', [CoresController::class, 'adminIndex'])->name('cores.index');
    Route::get('/cores/create', [CoresController::class, 'create'])->name('cores.create');
    Route::get('/cores/{id}/edit', [CoresController::class, 'edit'])->name('cores.edit');
    Route::post('/cores', [CoresController::class, 'store'])->name('cores.store');
    Route::put('/cores/{id}', [CoresController::class, 'update'])->name('cores.update');
    Route::delete('/cores/{core}', [CoresController::class, 'destroy'])->name('cores.destroy');
});