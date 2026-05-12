<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FinanzasApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0F6E56; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { border: none; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        .logo { color: #0F6E56; font-size: 24px; font-weight: 700; }
        .logo span { background: #0F6E56; color: white; padding: 4px 10px; border-radius: 8px; margin-right: 6px; }
        .btn-finanzas { background-color: #0F6E56; color: white; border: none; padding: 10px; font-size: 15px; border-radius: 8px; width: 100%; }
        .btn-finanzas:hover { background-color: #085041; color: white; }
        .form-control:focus { border-color: #1D9E75; box-shadow: 0 0 0 3px rgba(29,158,117,0.2); }
        .link-verde { color: #0F6E56; font-weight: 500; }
        .link-verde:hover { color: #085041; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <div class="text-center mb-4">
                        <div class="logo"><span>$</span>FinanzasApp</div>
                        <p class="text-muted mt-2">Bienvenido de vuelta</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required autofocus>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Tu contraseña" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label text-muted" for="remember">Recordarme</label>
                        </div>
                        <button type="submit" class="btn-finanzas">Iniciar sesión</button>
                    </form>
                    <p class="text-center mt-3 text-muted">¿No tienes cuenta? <a href="{{ route('register') }}" class="link-verde">Regístrate</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
