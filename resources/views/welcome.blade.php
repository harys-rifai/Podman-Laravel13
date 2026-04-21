<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --soft-primary: #cb0c9f;
            --soft-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
        }
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: var(--soft-gradient);
        }
        .hero-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 1rem 3rem rgba(0,0,0,0.175);
            padding: 3rem;
            max-width: 500px;
        }
        .hero h1 {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
        }
        .hero p {
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        .btn-soft {
            background: var(--soft-gradient);
            border: none;
            padding: 0.875rem 2rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-soft:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
        .feature-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }
        .feature-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center mb-4">
                        <i class="bi bi-hexagon text-white" style="font-size: 4rem;"></i>
                    </div>
                    <div class="hero-card text-center mx-auto">
                        <h1>Welcome to {{ config('app.name') }}</h1>
                        <p>Beautiful admin dashboard with Soft UI design</p>
                        <div class="d-grid gap-2">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-soft text-white">Go to Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-soft text-white">Sign In</a>
                                @if(Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>