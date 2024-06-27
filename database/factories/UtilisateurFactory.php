<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


 use App\Models\Utilisateur;

 class UtilisateurFactory extends Factory
 {
     protected $model = Utilisateur::class;
 
     public function definition()
     {
         return [
             'nom_utilisateur' => $this->faker->unique()->userName,
             'adresse_mail' => $this->faker->unique()->safeEmail,
             'prenom' => $this->faker->firstName,
             'nom' => $this->faker->lastName,
             'poste' => $this->faker->jobTitle,
             'statut' => $this->faker->boolean,
         ];
     }
 }