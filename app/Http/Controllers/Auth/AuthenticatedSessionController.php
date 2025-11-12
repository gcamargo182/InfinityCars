<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // DEBUG: Log de início do login
        Log::info('=== INÍCIO LOGIN ===');
        Log::info('Email recebido: ' . $request->email);
        
        // Autentica o usuário
        $request->authenticate();
        
        Log::info('✅ Autenticação bem-sucedida');

        // IMPORTANTE: Criar a session ANTES de regenerar
        $user = Auth::user();
        
        Log::info('Usuário autenticado: ' . $user->name . ' (ID: ' . $user->id . ')');
        
        // Cria a session personalizada ANTES de regenerar
        $request->session()->put('usuario_logado', [
            'id' => $user->id,
            'nome' => $user->name,
            'email' => $user->email
        ]);
        
        Log::info('✅ Session criada ANTES de regenerar');
        
        // Regenera a sessão por segurança
        $request->session()->regenerate();
        
        // Verificar se a session ainda existe após regenerar
        $sessionCheck = $request->session()->get('usuario_logado');
        Log::info('Session após regenerar: ' . ($sessionCheck ? json_encode($sessionCheck) : 'NULL/VAZIO'));
        
        // Se a session foi perdida na regeneração, criar novamente
        if (!$sessionCheck) {
            Log::info('⚠️ Session foi perdida! Criando novamente...');
            $request->session()->put('usuario_logado', [
                'id' => $user->id,
                'nome' => $user->name,
                'email' => $user->email
            ]);
            Log::info('✅ Session recriada após regenerar');
        }
        
        Log::info('✅ Redirecionando para: ' . RouteServiceProvider::HOME);

        return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Login realizado com sucesso!');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Log::info('=== INÍCIO LOGOUT ===');
        
        Auth::guard('web')->logout();

        // Remove a session personalizada
        Session::forget('usuario_logado');

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        Log::info('✅ Logout realizado com sucesso');

        return redirect('/')->with('success', 'Logout realizado com sucesso!');
    }
}
