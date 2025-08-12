<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmikar | Inicio de Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('images/farmikarlogo.png') }}" alt="Logo de la Empresa">
        </div>
        <div class="contenedor-formulario">
            <div class="cuadrado">
                <h2>Inicio de Sesión</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <center>
                        <label for="email">Correo</label>
                        </center>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="email" id="email" name="email" placeholder="usuario" required autofocus>
                        </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <center>
                        <label for="password">Contraseña</label>
                        </center>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="contraseña" required>
                        </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    <div class="button-group">
                        <button type="submit">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
