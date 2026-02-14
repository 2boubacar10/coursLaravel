@extends('layouts.app')

@section('title', 'Confirmation - Contact')

@section('styles')
<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
    }
    h1 {
        color: #4CAF50;
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
    .info-box h2 {
        margin-top: 0;
        color: #333;
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
@endsection

@section('content')
<div class="container">
    <h1>✓ Formulaire envoyé avec succès !</h1>

    <div class="success-message">
        Merci pour votre message. Nous avons bien reçu vos informations.
    </div>

    <div class="info-box">
        <h2>Informations reçues :</h2>

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
@endsection
