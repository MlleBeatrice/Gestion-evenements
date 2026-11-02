<article class="flex flex-col overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200 transition hover:shadow-md">
    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 px-5 py-4">
        <span class="inline-block rounded-full bg-white/20 px-3 py-1 text-xs font-medium text-white">
            {{ $event->category->name }}
        </span>
    </div>

    <div class="flex flex-1 flex-col p-5">
        <h2 class="text-lg font-semibold leading-snug text-gray-900">
            {{ $event->title }}
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            {{ \Illuminate\Support\Str::limit($event->description, 100) }}
        </p>

        <dl class="mt-4 space-y-1 text-sm text-gray-600">
            <div>
                <dt class="inline font-medium text-gray-700">Date :</dt>
                <dd class="inline">{{ $event->event_date->translatedFormat('d F Y à H\hi') }}</dd>
            </div>
            <div>
                <dt class="inline font-medium text-gray-700">Lieu :</dt>
                <dd class="inline">{{ $event->location }}</dd>
            </div>
        </dl>

        <div class="mt-auto flex items-center justify-between pt-5">
            @if ($event->isFull())
                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">Complet</span>
            @else
                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                    {{ $event->remaining_seats }} place(s) restante(s)
                </span>
            @endif

            <a href="{{ route('events.show', $event) }}"
               class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                Voir le détail
            </a>
        </div>
    </div>
</article>