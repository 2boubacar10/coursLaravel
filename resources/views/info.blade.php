@extends('layouts.app')

@section('title', 'Information')

@section('content')
<div class="container">
    <h1>Information</h1>
    <p>Ton âge est : <strong>{{ $age }} ans</strong></p>
    <p>Cette page affiche les informations dynamiques passées via l'URL.</p>
</div>
@endsection
