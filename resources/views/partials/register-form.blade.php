<div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
    <h2 class="text-lg font-semibold text-gray-900">S'inscrire à cet événement</h2>

    @if ($event->isFull())
        <p class="mt-3 rounded-lg bg-yellow-50 px-4 py-3 text-sm text-yellow-800">
            Désolé, cet événement est complet. Les inscriptions sont fermées.
        </p>
    @else
        <form action="{{ route('registrations.store', $event) }}" method="POST" class="mt-4 space-y-4">
            @csrf

            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Votre nom</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="w-full rounded-lg border px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 {{ $errors->has('name') ? 'border-red-400' : 'border-gray-300' }}">
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-gray-700">Votre email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full rounded-lg border px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 {{ $errors->has('email') ? 'border-red-400' : 'border-gray-300' }}">
            </div>

            <button type="submit"
                    class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                Confirmer l'inscription
            </button>
        </form>
    @endif
</div>