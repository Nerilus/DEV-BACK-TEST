<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom_utilisateur', 'adresse_mail', 'prenom', 'nom', 'poste', 'statut'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_utilisateur', 'utilisateur_id', 'service_id');
    }
}