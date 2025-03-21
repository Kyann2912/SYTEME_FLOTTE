<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChauffeurController extends Controller
{
    // Afficher la liste des chauffeurs
    public function index()
    {
        $response = Http::get('http://localhost:8081/api/chauffeurs');
        
        if ($response->successful()) {
            $chauffeurs = $response->json();
            return view('liste_chauffeur', compact('chauffeurs'));
        } else {
            return redirect('/chauffeurs')->with('error', 'Erreur lors de la récupération des chauffeurs.');
        }
    }

    // Afficher le formulaire d'ajout d'un chauffeur
    public function create()
    {
        return view('chauffeur');
    }

    // Ajouter un chauffeur via l'API
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:50',
            'prenoms' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'contact' => 'required|string|max:15',
            'adresse' => 'required|string|max:255',
        ]);

        // Données à envoyer à l'API
        $data = [
            'nom' => $validated['nom'],
            'prenoms' => $validated['prenoms'],
            'email' => $validated['email'],
            'contact' => $validated['contact'],
            'adresse' => $validated['adresse'],
        ];

        // Appel à l'API Spring Boot pour ajouter un chauffeur
        $response = Http::post('http://localhost:8081/api/chauffeurs', $data);

        // Vérifier si la réponse est réussie
        if ($response->successful()) {
            return redirect('/chauffeurs')->with('ajout', 'Chauffeur ajouté avec succès!');
        } else {
            // Récupérer l'erreur et afficher un message
            $errorMessage = $response->json()['message'] ?? 'Erreur inconnue';
            return redirect()->route('chauffeurs.create')->with('error', 'Erreur lors de l\'ajout du chauffeur : ' . $errorMessage);
        }
    }

    // Afficher le formulaire d'édition pour un chauffeur spécifique
    public function edit($id)
    {
        // Appel à l'API pour récupérer les détails du chauffeur
        $response = Http::get("http://localhost:8081/api/chauffeurs/{$id}");

        // Vérifier si la réponse est correcte
        if ($response->successful()) {
            $chauffeur = $response->json();  // Récupère les données du chauffeur
            return view('edit_chauffeur', compact('chauffeur'));  // Retourne la vue d'édition avec les données
        } else {
            return redirect('/chauffeurs')->with('error', 'Chauffeur introuvable');
        }
    }

    // Mettre à jour un chauffeur spécifique via l'API
    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:50',
            'prenoms' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'contact' => 'required|string|max:15',
            'adresse' => 'required|string|max:255',
        ]);

        // Appel à l'API pour mettre à jour le chauffeur
        $response = Http::put("http://localhost:8081/api/chauffeurs/{$id}", $validated);

        // Vérifier si la mise à jour a été effectuée avec succès
        if ($response->successful()) {
            return redirect('/chauffeurs')->with('success', 'Chauffeur modifié avec succès');
        } else {
            return redirect('/liste/chauffeurs')->with('error', 'Erreur lors de la modification du chauffeur');
        }
    }

    // Supprimer un chauffeur spécifique
    public function destroy($id)
    {
        // Appel à l'API pour supprimer le chauffeur
        $response = Http::delete("http://localhost:8081/api/chauffeurs/{$id}");

        // Vérifier si la suppression a réussi
        if ($response->successful()) {
            return redirect('/chauffeurs')->with('a', 'Chauffeur supprimé avec succès');
        } else {
            // Afficher l'erreur exacte dans les logs
            \Log::error("Erreur API lors de la suppression du chauffeur {$id}", [
                'response' => $response->body(),
                'status_code' => $response->status()
            ]);

            // Afficher un message d'erreur plus détaillé pour l'utilisateur
            $errorMessage = $response->json()['message'] ?? 'Erreur inconnue';
            return redirect('/chauffeurs')->with('b', 'Erreur lors de la suppression du chauffeur : ' . $errorMessage);
        }
    }
}
