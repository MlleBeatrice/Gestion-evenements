<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    // Enregistrer un participant avec gestion des messages
    public function store(Request $request, $eventId)
    {
        // 1. Valider les données du formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ], [
            // Messages personnalisés en français (optionnel mais propre)
            'name.required' => 'Le champ nom est obligatoire.',
            'email.required' => 'Le champ email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
        ]);

        $event = Event::findOrFail($eventId);

        // 2. Vérifier s'il reste des places
        $currentRegistrationsCount = $event->registrations()->count();

        if ($currentRegistrationsCount >= $event->total_seats) {
            return back()->withInput()->with('error', "Désolé, cet événement est complet ! Plus aucune place n'est disponible.");
        }

        // 3. Enregistrer l'inscription
        $event->registrations()->create($validated);

        // 4. Rediriger avec un message de succès
        return back()->with('success', "Félicitations ! Votre inscription a été enregistrée avec succès.");
    }

    // Annuler une inscription
    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return back()->with('success', "Votre inscription a bien été annulée.");
    }
}