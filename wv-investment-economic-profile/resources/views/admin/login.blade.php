<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | DTI</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: var(--bg-dark);
            margin: 0;
            font-family: 'Outfit', sans-serif;
        }

        .login-card {
            background: var(--glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            padding: 2.5rem;
            border-radius: 1.5rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            color: var(--accent);
            margin-bottom: 1rem;
        }

        h1 {
            font-size: 1.5rem;
            color: var(--text-primary);
            margin: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            color: var(--text-primary);
            font-family: inherit;
            transition: all 0.2s;
        }

        input:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(255, 255, 255, 0.08);
        }

        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, opacity 0.2s;
        }

        .btn-login:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .error-message {
            background: rgba(248, 113, 113, 0.1);
            color: #f87171;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(248, 113, 113, 0.2);
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="logo-section">
            <i data-lucide="shield-check" class="logo-icon"></i>
            <h1>Admin Access</h1>
            <p style="color: var(--text-secondary); font-size: 0.875rem; margin-top: 0.5rem;">Secure Portal Entrance</p>
        </div>

        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required autofocus placeholder="admin@example.com">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn-login">Authorize Entry</button>
        </form>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>