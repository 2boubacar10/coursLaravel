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

### Code de la validation

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

---

## Exercice 7 – Model Binding (Vidéo 9)

### Objectif
Comprendre et utiliser le Model Binding de Laravel pour récupérer automatiquement des modèles depuis la base de données via les routes.

### Contexte
Le Model Binding permet à Laravel de résoudre automatiquement les modèles Eloquent à partir des paramètres de route, simplifiant ainsi le code des contrôleurs.

### Tâches à réaliser

#### Partie A : Créer un modèle Article
1. Créer un modèle `Article` avec sa migration :
```bash
php artisan make:model Article -m
```

2. Dans la migration, définir la structure de la table `articles` :
   - `id` (auto-incrémenté)
   - `titre` (string, 255 caractères)
   - `contenu` (text)
   - `auteur` (string, 100 caractères)
   - `publie` (boolean, défaut: false)
   - `timestamps` (created_at, updated_at)

3. Configurer le modèle `Article` :
   - Définir les champs `$fillable`
   - Ajouter un cast pour `publie` en boolean

4. Exécuter la migration :
```bash
php artisan migrate
```

#### Partie B : Créer des données de test
1. Créer un seeder pour générer des articles :
```bash
php artisan make:seeder ArticleSeeder
```

2. Dans le seeder, créer au moins 5 articles avec des données variées

3. Exécuter le seeder :
```bash
php artisan db:seed --class=ArticleSeeder
```

#### Partie C : Implémenter le Model Binding
1. Créer un contrôleur `ArticleController` :
```bash
php artisan make:controller ArticleController
```

2. Dans le contrôleur, créer les méthodes suivantes :
   - `index()` : Afficher la liste de tous les articles
   - `show(Article $article)` : Afficher un article spécifique (utiliser le Model Binding)

3. Créer les routes correspondantes dans `web.php` :
   - `GET /articles` → liste des articles
   - `GET /articles/{article}` → détail d'un article (Model Binding automatique)

4. Créer les vues Blade :
   - `resources/views/articles/index.blade.php` : Liste des articles avec liens vers les détails
   - `resources/views/articles/show.blade.php` : Affichage d'un article complet

#### Partie D : Model Binding personnalisé
1. Modifier le modèle `Article` pour utiliser le slug au lieu de l'ID :
   - Ajouter une colonne `slug` dans la migration
   - Implémenter la méthode `getRouteKeyName()` pour retourner 'slug'

2. Mettre à jour les routes pour utiliser le slug :
   - `GET /articles/{article:slug}` (binding explicite)

### Critères de validation
- ✓ Le modèle Article est créé avec tous les champs requis
- ✓ La migration s'exécute sans erreur
- ✓ Au moins 5 articles sont créés via le seeder
- ✓ La page `/articles` affiche la liste de tous les articles
- ✓ La page `/articles/{id}` affiche les détails d'un article via Model Binding
- ✓ Si un article n'existe pas, une erreur 404 est retournée automatiquement
- ✓ (Bonus) Le Model Binding fonctionne avec le slug

### Ressources
- Documentation Laravel : [Route Model Binding](https://laravel.com/docs/10.x/routing#route-model-binding)

---

## Exercice 8 – Debugbar et IDE Helper (Vidéo 10)

### Objectif
Installer et configurer les outils de développement Laravel pour améliorer l'expérience de débogage et l'autocomplétion dans l'IDE.

### Contexte
Laravel Debugbar et IDE Helper sont des outils essentiels pour le développement qui permettent de visualiser les requêtes SQL, les performances et d'améliorer l'autocomplétion du code.

### Tâches à réaliser

#### Partie A : Installation de Laravel Debugbar
1. Installer le package via Composer :
```bash
composer require barryvdh/laravel-debugbar --dev
```

2. Publier la configuration (optionnel) :
```bash
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
```

3. Vérifier que la Debugbar apparaît en bas de page lors du développement

4. Explorer les différents onglets de la Debugbar :
   - Timeline : Temps d'exécution
   - Queries : Requêtes SQL exécutées
   - Models : Modèles chargés
   - Views : Vues rendues
   - Route : Informations sur la route actuelle

#### Partie B : Installation de Laravel IDE Helper
1. Installer le package via Composer :
```bash
composer require --dev barryvdh/laravel-ide-helper
```

2. Générer les fichiers d'aide pour l'IDE :
```bash
php artisan ide-helper:generate
php artisan ide-helper:models
php artisan ide-helper:meta
```

3. Ajouter les fichiers générés au `.gitignore` :
   - `_ide_helper.php`
   - `_ide_helper_models.php`
   - `.phpstorm.meta.php`

#### Partie C : Utilisation pratique
1. Créer une page de test `/debug-test` qui :
   - Récupère tous les articles de la base de données
   - Effectue plusieurs requêtes SQL différentes
   - Utilise des relations (si disponibles)

2. Observer dans la Debugbar :
   - Le nombre de requêtes SQL exécutées
   - Le temps d'exécution de chaque requête
   - Les requêtes N+1 potentielles

3. Optimiser les requêtes si nécessaire en utilisant `with()` pour l'eager loading

#### Partie D : Configuration avancée
1. Modifier le fichier `config/debugbar.php` pour :
   - Désactiver certains collecteurs non nécessaires
   - Configurer le stockage des données de debug

2. Créer des messages de debug personnalisés dans le code :
```php
\Debugbar::info('Message d\'information');
\Debugbar::warning('Message d\'avertissement');
\Debugbar::error('Message d\'erreur');
```


---

## Exercice 9 – Les Formulaires avancés (Vidéo 11)

### Objectif
Créer des formulaires complexes avec Laravel en utilisant les meilleures pratiques : Form Requests, CSRF protection, et gestion des fichiers.

### Contexte
Les formulaires sont au cœur de nombreuses applications web. Laravel offre des outils puissants pour les gérer de manière sécurisée et efficace.

### Tâches à réaliser

#### Partie A : Créer un Form Request personnalisé
1. Créer un Form Request pour la création d'articles :
```bash
php artisan make:request StoreArticleRequest
```

2. Dans `StoreArticleRequest`, définir :
   - Les règles de validation dans `rules()` :
     - `titre` : requis, string, max 255 caractères, unique
     - `contenu` : requis, string, min 50 caractères
     - `auteur` : requis, string, max 100 caractères
     - `publie` : boolean, optionnel
     - `image` : optionnel, fichier image (jpg, png), max 2MB
   
   - Les messages d'erreur personnalisés dans `messages()`
   - L'autorisation dans `authorize()` (retourner true pour l'instant)

3. Créer un second Form Request pour la mise à jour :
```bash
php artisan make:request UpdateArticleRequest
```

#### Partie B : Formulaire de création d'article
1. Ajouter les méthodes dans `ArticleController` :
   - `create()` : Afficher le formulaire de création
   - `store(StoreArticleRequest $request)` : Enregistrer un nouvel article

2. Créer la vue `resources/views/articles/create.blade.php` avec :
   - Un formulaire complet avec tous les champs
   - Protection CSRF (`@csrf`)
   - Affichage des erreurs de validation
   - Conservation des anciennes valeurs (`old()`)
   - Un champ de téléchargement d'image
   - Styles CSS pour une meilleure présentation

3. Ajouter les routes :
   - `GET /articles/create` → formulaire de création
   - `POST /articles` → enregistrement de l'article

#### Partie C : Gestion des fichiers uploadés
1. Configurer le stockage des fichiers dans `config/filesystems.php`

2. Dans la méthode `store()` du contrôleur :
   - Vérifier si une image a été uploadée
   - Stocker l'image dans `storage/app/public/articles`
   - Enregistrer le chemin dans la base de données

3. Créer un lien symbolique pour accéder aux fichiers :
```bash
php artisan storage:link
```

4. Afficher l'image dans la vue `show.blade.php`

#### Partie D : Formulaire de modification
1. Ajouter les méthodes dans `ArticleController` :
   - `edit(Article $article)` : Afficher le formulaire de modification
   - `update(UpdateArticleRequest $request, Article $article)` : Mettre à jour l'article

2. Créer la vue `resources/views/articles/edit.blade.php` :
   - Pré-remplir les champs avec les données existantes
   - Utiliser `@method('PUT')` pour la méthode HTTP
   - Permettre le remplacement de l'image

3. Ajouter les routes :
   - `GET /articles/{article}/edit` → formulaire de modification
   - `PUT /articles/{article}` → mise à jour de l'article

#### Partie E : Formulaire de suppression
1. Ajouter la méthode `destroy(Article $article)` dans le contrôleur

2. Ajouter un bouton de suppression dans `show.blade.php` :
   - Utiliser un formulaire avec `@method('DELETE')`
   - Ajouter une confirmation JavaScript avant suppression

3. Ajouter la route :
   - `DELETE /articles/{article}` → suppression de l'article

---

## Exercice 10 – Les Relations Eloquent (Vidéo 12)

### Objectif
Maîtriser les relations entre modèles dans Laravel (One-to-Many, Many-to-Many, etc.) et comprendre l'eager loading.

### Contexte
Les relations Eloquent permettent de gérer facilement les associations entre tables de base de données, rendant le code plus lisible et maintenable.

### Tâches à réaliser

#### Partie A : Relation One-to-Many (Un-à-Plusieurs)
1. Créer un modèle `Categorie` avec migration :
```bash
php artisan make:model Categorie -m
```

2. Dans la migration `categories` :
   - `id`
   - `nom` (string, unique)
   - `description` (text, nullable)
   - `timestamps`

3. Modifier la migration `articles` pour ajouter :
   - `categorie_id` (unsignedBigInteger, nullable, foreign key)

4. Définir les relations dans les modèles :
   - Dans `Categorie` : méthode `articles()` → `hasMany(Article::class)`
   - Dans `Article` : méthode `categorie()` → `belongsTo(Categorie::class)`

5. Créer un seeder pour les catégories et mettre à jour le seeder des articles

#### Partie B : Relation Many-to-Many (Plusieurs-à-Plusieurs)
1. Créer un modèle `Tag` avec migration :
```bash
php artisan make:model Tag -m
```

2. Dans la migration `tags` :
   - `id`
   - `nom` (string, unique)
   - `slug` (string, unique)
   - `timestamps`

3. Créer la table pivot `article_tag` :
```bash
php artisan make:migration create_article_tag_table
```

4. Dans la migration `article_tag` :
   - `id`
   - `article_id` (unsignedBigInteger, foreign key)
   - `tag_id` (unsignedBigInteger, foreign key)
   - `timestamps`
   - Index unique sur (article_id, tag_id)

5. Définir les relations dans les modèles :
   - Dans `Article` : méthode `tags()` → `belongsToMany(Tag::class)`
   - Dans `Tag` : méthode `articles()` → `belongsToMany(Article::class)`

#### Partie C : Utilisation des relations
1. Modifier `ArticleController@index` pour :
   - Charger les articles avec leurs catégories et tags (eager loading)
   - Utiliser `with(['categorie', 'tags'])`

2. Modifier la vue `articles/index.blade.php` pour afficher :
   - Le nom de la catégorie de chaque article
   - Les tags associés à chaque article

3. Modifier `ArticleController@show` pour :
   - Charger l'article avec sa catégorie et ses tags
   - Afficher les autres articles de la même catégorie

4. Créer une page `/categories` qui :
   - Liste toutes les catégories
   - Affiche le nombre d'articles par catégorie
   - Utilise `withCount('articles')`

5. Créer une page `/categories/{categorie}` qui :
   - Affiche tous les articles d'une catégorie
   - Utilise le Model Binding
