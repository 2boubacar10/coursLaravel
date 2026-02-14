<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function accueil()
    {
        return view('accueil');
    }

    // Afficher la page À propos
    public function apropos()
    {
        return view('apropos');
    }


    public function showContactForm()
    {
        return view('contact');
    }


    public function submitContactForm(Request $request)
    {
        //validation de la requete

        $donnesValides = $request->validate([
            'nom' => 'required',
            'email' => 'required|email',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être une adresse valide.',
        ]);


        $nom = $donnesValides['nom'];
        $email = $donnesValides['email'];


        return view('contact-confirmation', [
            'nom' => $nom,
            'email' => $email
        ]);
    }
}
