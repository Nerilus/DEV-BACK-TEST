<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Les URI qui doivent être exclues de la vérification CSRF.
     *
     * @var array
     */
    protected $except = [
        'api/*', // Exclut toutes les routes d'API
    ];
}
