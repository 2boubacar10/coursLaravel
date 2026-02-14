@extends('layouts.app')

@section('title', 'À propos')

@section('styles')
<style>
    .description {
        background-color: #f9f9f9;
        padding: 20px;
        border-left: 4px solid #4CAF50;
        margin: 20px 0;
    }
    .description ul {
        margin: 15px 0 15px 30px;
        color: #666;
    }
    .description li {
        margin-bottom: 8px;
        line-height: 1.6;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1>À propos de l'application</h1>

    <div class="description">
        <h2>Description</h2>
        <p>
            Cette application démontre les fonctionnalités de base de Laravel, notamment :
        </p>
        <ul>
            <li>Le système de routage flexible et intuitif</li>
            <li>Les contrôleurs pour organiser la logique métier</li>
            <li>Les vues Blade pour créer des templates dynamiques</li>
            <li>La validation des formulaires</li>
            <li>La gestion des requêtes HTTP</li>
        </ul>
        <p>
            L'objectif est de maîtriser les concepts fondamentaux de Laravel et de créer des applications
            web robustes et maintenables.
        </p>
    </div>
</div>
@endsection
