<?php

namespace App\Jobs;

use App\Models\Service;
use App\Models\Utilisateur;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ImportUtilisateursJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $response = Http::get('https://667c12f83c30891b865b318d.mockapi.io/utilisateurs');  // Remplacez par l'URL de l'API externe
        $utilisateursData = $response->json();

        foreach ($utilisateursData as $utilisateurData) {
            $utilisateur = Utilisateur::updateOrCreate(
                ['adresse_mail' => $utilisateurData['adresse_mail']],
                [
                    'nom_utilisateur' => $utilisateurData['nom_utilisateur'],
                    'prenom' => $utilisateurData['prenom'],
                    'nom' => $utilisateurData['nom'],
                    'poste' => $utilisateurData['poste'],
                    'statut' => $utilisateurData['statut'],
                ]
            );

            if (isset($utilisateurData['services'])) {
                $serviceIds = [];
                foreach ($utilisateurData['services'] as $serviceName) {
                    $service = Service::firstOrCreate(['nom' => $serviceName]);
                    $serviceIds[] = $service->id;
                }
                $utilisateur->services()->sync($serviceIds);
            }
        }
    }
}