<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    // Catalogue avec recherche, filtre par catégorie et filtre par date
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'exists:categories,slug'],
            'date' => ['nullable', 'date'],
        ]);

        $events = Event::with('category')
            ->withCount('registrations')
            ->search($filters['q'] ?? null)
            ->inCategory($filters['category'] ?? null)
            ->when(
                $filters['date'] ?? null,
                fn ($query, $date) => $query->onDate($date),
                fn ($query) => $query->upcoming()
            )
            ->orderBy('event_date')
            ->paginate(9)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('events.index', compact('events', 'categories'));
    }

    // Page de détail d'un événement
    public function show(Event $event): View
    {
        $event->load('category')->loadCount('registrations');

        return view('events.show', compact('event'));
    }
}