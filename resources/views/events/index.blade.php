@extends('layouts.app')

@section('title', 'Catalogue des événements')

@section('content')
    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Catalogue des événements</h1>
    <p class="mt-1 text-gray-600">Trouvez un événement et inscrivez-vous en quelques clics.</p>

    {{-- Filtres --}}
    <form method="GET" action="{{ route('events.index') }}"
          class="mt-6 grid grid-cols-1 gap-4 rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-200 sm:grid-cols-2 lg:grid-cols-4">
        <div>
            <label for="q" class="mb-1 block text-sm font-medium text-gray-700">Recherche</label>
            <input type="text" id="q" name="q" value="{{ request('q') }}"
                   placeholder="Titre, lieu, mot-clé"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
        </div>

        <div>
            <label for="category" class="mb-1 block text-sm font-medium text-gray-700">Catégorie</label>
            <select id="category" name="category"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                <option value="">Toutes les catégories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="date" class="mb-1 block text-sm font-medium text-gray-700">Date précise</label>
            <input type="date" id="date" name="date" value="{{ request('date') }}"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
        </div>

        <div class="flex items-end gap-2">
            <button type="submit"
                    class="flex-1 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                Filtrer
            </button>
            <a href="{{ route('events.index') }}"
               class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                Réinitialiser
            </a>
        </div>
    </form>

    {{-- Résultats --}}
    <p class="mt-6 text-sm text-gray-500">
        {{ $events->total() }} événement(s) trouvé(s)
    </p>

    @if ($events->count())
        <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($events as $event)
                @include('events._card', ['event' => $event])
            @endforeach
        </div>

        <div class="mt-8">
            {{ $events->links() }}
        </div>
    @else
        <div class="mt-6 rounded-xl border border-dashed border-gray-300 bg-white p-10 text-center text-gray-500">
            Aucun événement ne correspond à votre recherche.
        </div>
    @endif
@endsection