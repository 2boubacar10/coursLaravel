@extends('layouts.app')

@section('title', 'Formulaire de Contact')

@section('styles')
<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
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
@endsection

@section('content')
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
@endsection
