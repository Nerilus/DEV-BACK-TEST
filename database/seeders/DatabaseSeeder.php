<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // Créer des services
        $services = Service::factory()->count(5)->create();

        // Créer des utilisateurs et leur assigner des services aléatoires
        Utilisateur::factory()->count(20)->create()->each(function ($utilisateur) use ($services) {
            $utilisateur->services()->attach(
                $services->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}

