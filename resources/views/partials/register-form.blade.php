<div class="card shadow-sm mt-4">
    <div class="card-body">
        <h3 class="mb-3">S'inscrire à cet événement</h3>

        <!-- Message flash de succès -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Message flash d'erreur (ex: événement complet) -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Calcul dynamique des places restantes (nécessite que la variable $event soit passée à la vue) -->
        @php
            $registeredCount = $event->registrations->count();
            $remainingSeats = $event->total_seats - $registeredCount;
        @endphp

        <div class="alert {{ $remainingSeats > 0 ? 'alert-info' : 'alert-danger' }} mb-3">
            <strong>Places restantes :</strong> {{ $remainingSeats }} / {{ $event->total_seats }}
        </div>

        <!-- Affichage du formulaire si des places sont disponibles -->
        @if($remainingSeats > 0)
            <form action="{{ route('registrations.store', $event->id) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Votre Nom</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Votre Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Confirmer l'inscription</button>
            </form>
        @else
            <div class="alert alert-warning text-center mb-0">
                <strong>Désolé !</strong> Cet événement affiche complet. Les inscriptions sont fermées.
            </div>
        @endif

    </div>
</div>