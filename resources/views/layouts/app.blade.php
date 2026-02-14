<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Application Laravel')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navigation */
        nav {
            background-color: #2c3e50;
            padding: 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .nav-brand {
            color: white;
            font-size: 24px;
            font-weight: bold;
            padding: 15px 0;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 0;
        }

        .nav-menu li {
            margin: 0;
        }

        .nav-menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 20px 20px;
            transition: background-color 0.3s;
        }

        .nav-menu a:hover {
            background-color: #34495e;
        }

        .nav-menu a.active {
            background-color: #4CAF50;
        }

        /* Main Content */
        main {
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 30px auto;
            padding: 0 20px;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }

        h2 {
            color: #555;
            margin-top: 25px;
            margin-bottom: 15px;
        }

        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                padding: 10px 20px;
            }

            .nav-brand {
                padding: 10px 0;
            }

            .nav-menu {
                flex-direction: column;
                width: 100%;
            }

            .nav-menu a {
                text-align: center;
                padding: 12px 20px;
                border-top: 1px solid #34495e;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="/" class="nav-brand">Laravel App</a>
            <ul class="nav-menu">
                <li><a href="/accueil" class="{{ request()->is('accueil') ? 'active' : '' }}">Accueil</a></li>
                <li><a href="/apropos" class="{{ request()->is('apropos') ? 'active' : '' }}">À propos</a></li>
                <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
                <li><a href="/info/25" class="{{ request()->is('info/*') ? 'active' : '' }}">Info</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Mon Application Laravel. Tous droits réservés.</p>
    </footer>

    @yield('scripts')
</body>
</html>
