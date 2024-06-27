<?php 
namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index(Request $request)
    {
        $query = Utilisateur::with('services');

        // Filtrage par service
        if ($request->has('service')) {
            $query->whereHas('services', function ($q) use ($request) {
                $q->where('nom', $request->service);
            });
        }

        // Tri
        if ($request->has('sort_by') && $request->has('order')) {
            $query->orderBy($request->sort_by, $request->order);
        }

        // Pagination
        $utilisateurs = $query->paginate($request->get('per_page', 10));

        return response()->json($utilisateurs);
    }

    public function show($id)
    {
        $utilisateur = Utilisateur::with('services')->findOrFail($id);
        return response()->json($utilisateur);
    }

    public function update(Request $request, $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->update($request->all());

        if ($request->has('services')) {
            $utilisateur->services()->sync($request->services);
        }

        return response()->json($utilisateur);
    }

    public function destroy($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès']);
    }

    public function sync(Request $request)
    {
        // Implémentation de la synchronisation avec une API externe
    }
}
