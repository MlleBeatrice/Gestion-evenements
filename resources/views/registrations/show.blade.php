@extends('layouts.app')

@section('title', 'Confirmation d\'inscription')

@section('content')
    <div class="mx-auto max-w-xl">
        <h1 class="text-2xl font-bold text-gray-900">Récapitulatif de votre inscription</h1>

        <div class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <dl class="space-y-4 text-sm">
                <div>
                    <dt class="font-medium text-gray-500">Événement</dt>
                    <dd class="mt-1 text-gray-900">{{ $registration->event->title }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-500">Catégorie</dt>
                    <dd class="mt-1 text-gray-900">{{ $registration->event->category->name }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-500">Date et heure</dt>
                    <dd class="mt-1 text-gray-900">{{ $registration->event->event_date->translatedFormat('l d F Y à H\hi') }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-500">Lieu</dt>
                    <dd class="mt-1 text-gray-900">{{ $registration->event->location }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-500">Nom</dt>
                    <dd class="mt-1 text-gray-900">{{ $registration->name }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-gray-900">{{ $registration->email }}</dd>
                </div>
            </dl>
        </div>

        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('events.index') }}"
               class="rounded-lg bg-orange-600 px-4 py-2 text-center text-sm font-medium text-white hover:bg-orange-700">
                Retour au catalogue
            </a>

            <form action="{{ route('registrations.destroy', $registration) }}" method="POST"
                  onsubmit="return confirm('Voulez-vous vraiment annuler cette inscription ?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full rounded-lg border border-red-300 px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-50">
                    Annuler mon inscription
                </button>
            </form>
        </div>
    </div>
@endsection