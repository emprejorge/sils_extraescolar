<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión — Mimetic</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #f0f2f7;
            --card-bg: #fcfcfc;
            --border: #e8eaed;
            --text: #424242;
            --text-heading: #585858;
            --text-muted: #8b90a7;
            --accent: #223654;
            --accent-hover: #1a2940;
            --google-bg: #ffffff;
            --google-hover: #f4f5f7;
            --google-border: #e8eaed;
            --divider: #e8eaed;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 4px 16px rgba(0, 0, 0, 0.04);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #0f1117;
                --card-bg: #1c1e28;
                --border: #2a2d3a;
                --text: #e8eaf0;
                --text-muted: #5c6070;
                --google-bg: #22253a;
                --google-hover: #272a3d;
                --google-border: #2a2d3a;
                --divider: #2a2d3a;
                --shadow: 0 4px 32px rgba(0, 0, 0, 0.35);
            }
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px 16px;
        }

        /* Fondo con patrón de puntos sutil */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(circle, var(--border) 1px, transparent 1px);
            background-size: 28px 28px;
            opacity: .5;
            pointer-events: none;
            z-index: 0;
        }

        .login-card {
            position: relative;
            z-index: 1;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px 40px 36px;
            width: 100%;
            max-width: 400px;
            box-shadow: var(--shadow);
        }

        /* Logo del colegio */
        .school-logo {
            display: block;
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 16px;
            border: 1px solid var(--border);
            background: #fff;
            margin: 0 auto 20px;
            padding: 8px;
        }

        .login-title {
            font-family: 'Lato', sans-serif;
            font-weight: 900;
            font-size: 1.45rem;
            letter-spacing: -0.01em;
            color: var(--text-heading);
            text-align: center;
            margin-bottom: 4px;
        }

        .login-subtitle {
            font-size: .85rem;
            color: var(--text-muted);
            text-align: center;
            margin-bottom: 28px;
            line-height: 1.5;
        }

        /* Mensaje flash CI (success / error / info) */
        .flash-msg {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: .82rem;
            font-weight: 500;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        .flash-msg.error {
            background: rgba(239, 68, 68, .08);
            border-color: rgba(239, 68, 68, .2);
            color: #ef4444;
        }

        .flash-msg.info {
            background: rgba(59, 130, 246, .08);
            border-color: rgba(59, 130, 246, .2);
            color: #3b82f6;
        }

        .flash-msg.success {
            background: rgba(34, 197, 94, .08);
            border-color: rgba(34, 197, 94, .2);
            color: #22c55e;
        }

        /* Botón Google */
        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 12px 20px;
            background: var(--google-bg);
            border: 1px solid var(--google-border);
            border-radius: 12px;
            font-family: 'Lato', sans-serif;
            font-size: .95rem;
            font-weight: 700;
            color: var(--text);
            cursor: pointer;
            text-decoration: none;
            transition: background .2s, border-color .2s, transform .15s;
            margin-bottom: 20px;
        }

        .btn-google:hover {
            background: var(--google-hover);
            border-color: var(--accent);
            color: var(--text);
            transform: translateY(-1px);
        }

        .btn-google:active {
            transform: translateY(0);
        }

        /* SVG logo Google */
        .google-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            color: var(--text-muted);
            font-size: .75rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--divider);
        }

        /* Info institucional */
        .login-info {
            text-align: center;
            font-size: .78rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .login-info strong {
            color: var(--text);
            font-weight: 500;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 24px;
            font-size: .75rem;
            color: var(--text-muted);
        }

        .login-footer a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color .2s;
        }

        .login-footer a:hover {
            color: var(--accent);
        }

        .brand-dot {
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
            margin-bottom: 2px;
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <!-- Logo colegio -->
        <img src="https://www.scuolaitalianalaserena.cl/logos/logo-chico-fondo-blanco.jpg"
            alt="Scuola Italiana La Serena"
            class="school-logo"
            onerror="this.style.display='none'">

        <h1 class="login-title">Bienvenido</h1>
        <p class="login-subtitle">
            Accede con tu cuenta institucional<br>para continuar a la plataforma.
        </p>

        <!-- Flash message desde CI (descomentar según corresponda) -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="flash-msg error">
                <i class="bi bi-exclamation-circle-fill"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php elseif (session()->getFlashdata('info')): ?>
            <div class="flash-msg info">
                <i class="bi bi-info-circle-fill"></i>
                <?= session()->getFlashdata('info') ?>
            </div>
        <?php elseif (session()->getFlashdata('success')): ?>
            <div class="flash-msg success">
                <i class="bi bi-check-circle-fill"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Botón Google OAuth -->
        <a href="<?= site_url('auth/google') ?>" class="btn-google">
            <svg class="google-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
            </svg>
            Continuar con Google
        </a>

        <div class="divider">Solo acceso institucional</div>

        <!-- Info -->
        <p class="login-info">
            Debes iniciar sesión con tu cuenta
            <strong>@scuolaitalianalaserena.cl</strong><br>
            asignada por el colegio.
        </p>

    </div>

    <!-- Footer fuera de la card -->
    <div class="login-footer" style="position:fixed;bottom:20px;left:0;right:0">
        <span class="brand-dot"></span>
        Mimetic &mdash; <?= date('Y') ?> &nbsp;&middot;&nbsp;
        <a href="#">Soporte</a>
    </div>

</body>

</html>