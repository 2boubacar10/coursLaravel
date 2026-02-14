# Livrables des Exercices Laravel

## Exercice 4 – Route dynamique ✓

### Code de la route (routes/web.php)
```php
Route::get('/info/{age}', function ($age) {
    return view('info', ['age' => $age]);
});
```

### Code de la vue (resources/views/info.blade.php)
```html
<!DOCTYPE html>
<html>
<head>
    <title>Information</title>
</head>
<body>
    <h1>Information</h1>
    <p>Ton âge est : {{ $age }} ans</p>
</body>
</html>
```

### Test
- URL : http://localhost:8000/info/25
- Résultat : "Ton âge est : 25 ans"

---

## Exercice 5 – Formulaire HTML simple ✓

### Code des routes (routes/web.php)
```php
// Exercice 5 & 6 - Formulaire de contact
Route::get('/contact', [PageController::class, 'showContactForm']);
Route::post('/contact', [PageController::class, 'submitContactForm']);
```

### Code du contrôleur (app/Http/Controllers/PageController.php)
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function accueil()
    {
        return view('accueil');
    }

    // Afficher le formulaire de contact
    public function showContactForm()
    {
        return view('contact');
    }

    // Traiter la soumission du formulaire avec validation
    public function submitContactForm(Request $request)
    {
        // Validation des données (Exercice 6)
        $validated = $request->validate([
            'nom' => 'required',
            'email' => 'required|email',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être une adresse valide.',
        ]);

        // Récupérer les données validées
        $nom = $validated['nom'];
        $email = $validated['email'];

        // Afficher la vue de confirmation
        return view('contact-confirmation', [
            'nom' => $nom,
            'email' => $email
        ]);
    }
}
```

### Code du formulaire (resources/views/contact.blade.php)
```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #4CAF50;
        }
        .error {
            color: #d32f2f;
            font-size: 13px;
            margin-top: 5px;
        }
        .error-input {
            border-color: #d32f2f !important;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulaire de Contact</h1>

        {{-- Afficher les erreurs de validation globales --}}
        @if ($errors->any())
            <div class="alert">
                <strong>Erreur !</strong> Veuillez corriger les erreurs suivantes :
                <ul style="margin: 10px 0 0 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/contact" method="POST">
            @csrf

            <div class="form-group">
                <label for="nom">Nom *</label>
                <input 
                    type="text" 
                    id="nom" 
                    name="nom" 
                    value="{{ old('nom') }}"
                    class="@error('nom') error-input @enderror"
                    placeholder="Entrez votre nom"
                >
                @error('nom')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="@error('email') error-input @enderror"
                    placeholder="Entrez votre email"
                >
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>
```

### Code de la vue de confirmation (resources/views/contact-confirmation.blade.php)
```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation - Contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        .success-message {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 25px;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #4CAF50;
            padding: 20px;
            margin-bottom: 20px;
        }
        .info-row {
            margin-bottom: 15px;
        }
        .info-label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 80px;
        }
        .info-value {
            color: #333;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✓ Formulaire envoyé avec succès !</h1>
        
        <div class="success-message">
            Merci pour votre message. Nous avons bien reçu vos informations.
        </div>

        <div class="info-box">
            <h2 style="margin-top: 0; color: #333;">Informations reçues :</h2>
            
            <div class="info-row">
                <span class="info-label">Nom :</span>
                <span class="info-value">{{ $nom }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Email :</span>
                <span class="info-value">{{ $email }}</span>
            </div>
        </div>

        <a href="/contact" class="back-link">← Retour au formulaire</a>
    </div>
</body>
</html>
```

### Test
- URL formulaire : http://localhost:8000/contact
- Remplir le formulaire et soumettre
- Voir la page de confirmation avec les données

---

## Exercice 6 – Validation de formulaire ✓

### Code de la validation (déjà inclus dans PageController.php)

La validation est implémentée dans la méthode `submitContactForm()` :

```php
// Validation des données
$validated = $request->validate([
    'nom' => 'required',
    'email' => 'required|email',
], [
    'nom.required' => 'Le nom est obligatoire.',
    'email.required' => 'L\'email est obligatoire.',
    'email.email' => 'L\'email doit être une adresse valide.',
]);
```

### Règles de validation
- **nom** : obligatoire (`required`)
- **email** : obligatoire (`required`) ET doit être un email valide (`email`)

### Affichage des erreurs dans la vue

Le formulaire contact.blade.php inclut :

1. **Affichage global des erreurs** :
```blade
@if ($errors->any())
    <div class="alert">
        <strong>Erreur !</strong> Veuillez corriger les erreurs suivantes :
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

2. **Affichage des erreurs par champ** :
```blade
@error('nom')
    <div class="error">{{ $message }}</div>
@enderror
```

3. **Conservation des valeurs saisies** :
```blade
value="{{ old('nom') }}"
```

4. **Style visuel pour les champs en erreur** :
```blade
class="@error('nom') error-input @enderror"
```

### Tests de validation

**Test 1 : Formulaire vide**
- Soumettre le formulaire sans remplir les champs
- Résultat : Messages d'erreur "Le nom est obligatoire." et "L'email est obligatoire."

**Test 2 : Email invalide**
- Nom : "Jean Dupont"
- Email : "email-invalide"
- Résultat : Message d'erreur "L'email doit être une adresse valide."

**Test 3 : Données valides**
- Nom : "Jean Dupont"
- Email : "jean.dupont@example.com"
- Résultat : Redirection vers la page de confirmation avec les données affichées

---

## Instructions pour tester

1. Démarrer le serveur Laravel :
```bash
php artisan serve
```

2. Tester les URLs :
   - **Exercice 4** : http://localhost:8000/info/25
   - **Exercice 5 & 6** : http://localhost:8000/contact

3. Pour tester la validation :
   - Essayer de soumettre le formulaire vide
   - Essayer avec un email invalide (ex: "test")
   - Essayer avec des données valides

---

## Fichiers créés/modifiés

### Fichiers modifiés :
- `routes/web.php` - Ajout des routes GET et POST /contact
- `app/Http/Controllers/PageController.php` - Ajout des méthodes showContactForm() et submitContactForm()

### Fichiers créés :
- `resources/views/contact.blade.php` - Formulaire de contact avec validation
- `resources/views/contact-confirmation.blade.php` - Page de confirmation

### Fichiers existants (Exercice 4) :
- `resources/views/info.blade.php` - Vue pour afficher l'âge
- Route `/info/{age}` dans `routes/web.php`
