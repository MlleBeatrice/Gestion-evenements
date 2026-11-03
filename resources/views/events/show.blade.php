@extends('layouts.app')

@section('title', $event->title)

@section('content')
    <a href="{{ route('events.index') }}" class="text-sm font-medium text-orange-600 hover:underline">
        Retour au catalogue
    </a>

    <div class="mt-4 grid grid-cols-1 gap-8 lg:grid-cols-3">

        {{-- Informations de l'événement --}}
        <article class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200 lg:col-span-2">
            <div class="bg-gradient-to-r from-orange-500 to-orange-500 px-6 py-6">
                <span class="inline-block rounded-full bg-white/20 px-3 py-1 text-xs font-medium text-white">
                    {{ $event->category->name }}
                </span>
                <h1 class="mt-3 text-2xl font-bold text-white sm:text-3xl">{{ $event->title }}</h1>
            </div>

            <div class="p-6">
                <dl class="grid grid-cols-1 gap-4 text-sm sm:grid-cols-2">
                    <div>
                        <dt class="font-medium text-gray-500">Date et heure</dt>
                        <dd class="mt-1 text-gray-900">{{ $event->event_date->translatedFormat('l d F Y à H\hi') }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">Lieu</dt>
                        <dd class="mt-1 text-gray-900">{{ $event->location }}</dd>
                    </div>
                </dl>

                <h2 class="mt-6 text-lg font-semibold text-gray-900">Description</h2>
                <p class="mt-2 whitespace-pre-line leading-relaxed text-gray-700">{{ $event->description }}</p>
            </div>
        </article>

        {{-- Colonne latérale : places et inscription --}}
        <aside class="space-y-6">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Places disponibles</h2>

                @php
                    $taken = $event->registrations_count;
                    $percent = $event->capacity > 0 ? min(100, round($taken / $event->capacity * 100)) : 100;
                @endphp

                <p class="mt-2 text-3xl font-bold {{ $event->isFull() ? 'text-red-600' : 'text-green-600' }}">
                    {{ $event->remaining_seats }}
                    <span class="text-base font-medium text-gray-500">/ {{ $event->capacity }}</span>
                </p>

                <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                    <div class="h-2 rounded-full {{ $event->isFull() ? 'bg-red-500' : 'bg-orange-500' }}"
                         style="width: {{ $percent }}%"></div>
                </div>

                @if ($event->isFull())
                    <p class="mt-3 text-sm font-medium text-red-600">Cet événement est complet.</p>
                @endif
            </div>

            {{-- Formulaire d'inscription (partie Membre 2) --}}
            @include('partials.register-form')
        </aside>
    </div>
@endsection