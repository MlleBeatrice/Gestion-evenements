<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $cat = Category::pluck('id', 'slug');

        $events = [
            [
                'category_id' => $cat['conference'],
                'title' => "Conférence sur l'intelligence artificielle en Afrique",
                'description' => "Une journée d'échanges avec des chercheurs et des entrepreneurs sur les usages concrets de l'intelligence artificielle dans l'agriculture, la santé et l'éducation en Afrique de l'Ouest.",
                'location' => 'Cotonou, Palais des Congrès',
                'event_date' => now()->addDays(5)->setTime(9, 0),
                'capacity' => 200,
            ],
            [
                'category_id' => $cat['atelier'],
                'title' => 'Atelier Laravel pour débutants',
                'description' => "Apprenez à construire une application web complète avec Laravel : routes, contrôleurs, migrations et vues Blade. Apportez votre ordinateur portable.",
                'location' => 'Abomey-Calavi, IFRI-UAC',
                'event_date' => now()->addDays(7)->setTime(14, 30),
                'capacity' => 40,
            ],
            [
                'category_id' => $cat['concert'],
                'title' => 'Soirée Afro-Jazz de Ouidah',
                'description' => "Une soirée musicale mêlant jazz et rythmes traditionnels béninois, avec des artistes locaux et invités, dans un cadre en plein air.",
                'location' => 'Ouidah, Place Chacha',
                'event_date' => now()->addDays(10)->setTime(19, 0),
                'capacity' => 300,
            ],
            [
                'category_id' => $cat['sport'],
                'title' => 'Marathon de la Route des Pêches',
                'description' => "Course à pied de 10 km et de 21 km le long du littoral, ouverte aux coureurs de tous niveaux, avec ravitaillements et médaille à l'arrivée.",
                'location' => 'Grand-Popo, Plage',
                'event_date' => now()->addDays(14)->setTime(6, 30),
                'capacity' => 500,
            ],
            [
                'category_id' => $cat['formation'],
                'title' => 'Formation en marketing digital',
                'description' => "Deux jours pour maîtriser les réseaux sociaux, la création de contenu et la publicité en ligne afin de développer votre activité.",
                'location' => 'Cotonou, Haie Vive',
                'event_date' => now()->addDays(12)->setTime(9, 0),
                'capacity' => 60,
            ],
            [
                'category_id' => $cat['networking'],
                'title' => 'Rencontre des jeunes entrepreneurs du Bénin',
                'description' => "Une soirée de mise en relation entre porteurs de projets, investisseurs et mentors, avec des pitchs de trois minutes et un cocktail.",
                'location' => 'Cotonou, Hôtel du Lac',
                'event_date' => now()->addDays(9)->setTime(18, 0),
                'capacity' => 120,
            ],
            [
                'category_id' => $cat['conference'],
                'title' => 'Forum sur la cybersécurité',
                'description' => "Des experts présentent les menaces actuelles et les bonnes pratiques de protection des données pour les entreprises et les institutions.",
                'location' => 'Porto-Novo, Centre culturel',
                'event_date' => now()->addDays(20)->setTime(10, 0),
                'capacity' => 150,
            ],
            [
                'category_id' => $cat['atelier'],
                'title' => 'Atelier de design avec Figma',
                'description' => "Initiez-vous à la conception d'interfaces : maquettes, composants et prototypes interactifs, du croquis à l'écran final.",
                'location' => 'Parakou, Espace Numérique',
                'event_date' => now()->addDays(16)->setTime(15, 0),
                'capacity' => 30,
            ],
            [
                'category_id' => $cat['concert'],
                'title' => 'Festival de musique urbaine',
                'description' => "Rap, afrobeat et danse sur trois scènes, avec les meilleurs artistes de la nouvelle scène béninoise.",
                'location' => 'Cotonou, Stade de l\'Amitié',
                'event_date' => now()->addDays(25)->setTime(17, 0),
                'capacity' => 1000,
            ],
            [
                'category_id' => $cat['sport'],
                'title' => 'Tournoi de football inter-universités',
                'description' => "Les équipes des universités du Bénin s'affrontent pendant une journée de matchs et de finales.",
                'location' => 'Abomey-Calavi, Terrain universitaire',
                'event_date' => now()->addDays(18)->setTime(8, 0),
                'capacity' => 250,
            ],
            [
                'category_id' => $cat['formation'],
                'title' => 'Introduction à la comptabilité pour les PME',
                'description' => "Les bases pour tenir ses comptes, suivre sa trésorerie et préparer ses déclarations, avec des exercices pratiques.",
                'location' => 'Parakou, Chambre de commerce',
                'event_date' => now()->addDays(22)->setTime(9, 30),
                'capacity' => 50,
            ],
            [
                // Petit effectif pour tester facilement le statut "Complet"
                'category_id' => $cat['networking'],
                'title' => 'Petit-déjeuner des développeurs',
                'description' => "Un moment convivial pour échanger sur vos projets, partager des astuces et rencontrer d'autres développeurs de la région.",
                'location' => 'Cotonou, Fidjrossè',
                'event_date' => now()->addDays(3)->setTime(8, 0),
                'capacity' => 5,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}