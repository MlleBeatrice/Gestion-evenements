<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    // Enregistrer un participant
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('registrations')->where('event_id', $event->id),
            ],
        ], [
            'name.required' => 'Le champ nom est obligatoire.',
            'email.required' => 'Le champ email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cet email est déjà inscrit à cet événement.',
        ]);

        // Vérifier qu'il reste des places
        if ($event->registrations()->count() >= $event->capacity) {
            return back()->withInput()->with('error', "Désolé, cet événement est complet. Plus aucune place n'est disponible.");
        }

        $registration = $event->registrations()->create($validated);

        return redirect()
            ->route('registrations.show', $registration)
            ->with('success', 'Félicitations ! Votre inscription a été enregistrée avec succès.');
    }

    // Page de confirmation / récapitulatif
    public function show(Registration $registration): View
    {
        $registration->load('event.category');

        return view('registrations.show', compact('registration'));
    }

    // Annuler une inscription
    public function destroy(Registration $registration)
    {
        $event = $registration->event;
        $registration->delete();

        return redirect()
            ->route('events.show', $event)
            ->with('success', 'Votre inscription a bien été annulée.');
    }
}