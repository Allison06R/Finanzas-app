<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $email = $request->email;
        $keyIntentos  = 'login_intentos_'  . md5($email);
        $keyBloqueado = 'login_bloqueado_' . md5($email);
        $keyHasta     = 'login_hasta_'     . md5($email);

        // Verificar si está bloqueado
        if (Session::get($keyBloqueado)) {
            $hasta = Session::get($keyHasta);
            if ($hasta && Carbon::now()->lt($hasta)) {
                $minutos = Carbon::now()->diffInMinutes($hasta) + 1;
                return back()->withErrors([
                    'email' => "Cuenta bloqueada. Intenta de nuevo en {$minutos} minuto(s)."
                ]);
            } else {
                // El bloqueo ya expiró, limpiar
                Session::forget([$keyBloqueado, $keyHasta, $keyIntentos]);
            }
        }

        // Buscar usuario
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Las credenciales no coinciden con nuestros registros.'
            ]);
        }

        // Verificar si está bloqueado por admin
        if ($user->bloqueado) {
            return back()->withErrors([
                'email' => 'Tu cuenta ha sido bloqueada. Contacta al administrador.'
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {

            $intentos = Session::get($keyIntentos, 0) + 1;
            Session::put($keyIntentos, $intentos);

            if ($intentos >= 3) {
                $hasta = Carbon::now()->addMinutes(5);
                Session::put($keyBloqueado, true);
                Session::put($keyHasta, $hasta);
                Session::put($keyIntentos, 0);

                return back()->withErrors([
                    'email' => 'Demasiados intentos fallidos. Cuenta bloqueada por 5 minutos.'
                ]);
            }

            $restantes = 3 - $intentos;
            return back()->withErrors([
                'email' => "Contraseña incorrecta. Te quedan {$restantes} intento(s)."
            ]);
        }

       
        Session::forget([$keyIntentos, $keyBloqueado, $keyHasta]);

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        // Cookie con nombre del usuario (7 días)
        $cookie = Cookie::make('user_name', $user->name, 60 * 24 * 7);

        if ($user->isAdmin()) {
            return redirect()->route('dashboard')->withCookie($cookie);
        }

        return redirect()->route('dashboard')->withCookie($cookie);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->withCookie(Cookie::forget('user_name'));
    }
}