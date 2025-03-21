<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuiviController extends Controller
{
    // Afficher la liste des suivis
    public function index()
    {
        // Appel à l'API Spring Boot pour récupérer la liste des suivis de véhicules
        $response = Http::get('http://localhost:8081/api/v1/trackings');

        // Vérifier si la réponse est correcte
        if ($response->successful()) {
            $trackings = $response->json();  // Récupérer les données des suivis
            return view('liste_suivi', compact('trackings'));
        } else {
            return redirect('/suivis')->with('error', 'Erreur lors de la récupération des suivis.');
        }
    }

    // Afficher le formulaire d'ajout d'un suivi
    public function create()
    {
        // Récupérer la liste des véhicules
        $responseVehicules = Http::get('http://localhost:8081/api/vehicules');
        $vehicules = $responseVehicules->successful() ? $responseVehicules->json() : [];
    
        // Récupérer la liste des chauffeurs
        $responseChauffeurs = Http::get('http://localhost:8081/api/chauffeurs');
        $chauffeurs = $responseChauffeurs->successful() ? $responseChauffeurs->json() : [];
    
        // Récupérer la liste des trajets
        $responseTrajets = Http::get('http://localhost:8081/api/trajets');
        $trajets = $responseTrajets->successful() ? $responseTrajets->json() : [];
    
        // Passer les données récupérées à la vue
        return view('suivi', compact('vehicules', 'trajets'));
    }
    
    

    // Ajouter un suivi via l'API
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'immatriculation' => 'required|string|max:255',
            'longitude' => 'required|numeric',
            'altitude' => 'required|numeric',
            'trajet' => 'required|string|max:255',
        ]);

        // Données à envoyer à l'API
        $data = [
            'immatriculation' => $validated['immatriculation'],
            'longitude' => $validated['longitude'],
            'altitude' => $validated['altitude'],
            'trajet' => $validated['trajet'],
        ];

        // Appel à l'API Spring Boot pour ajouter un suivi
        $response = Http::post('http://localhost:8081/api/v1/trackings', $data);

        // Vérifier si la réponse est réussie
        if ($response->successful()) {
            return redirect('/ko')->with('success', 'Suivi ajouté avec succès!');
        } else {
            // Récupérer l'erreur et afficher un message
            $errorMessage = $response->json()['message'] ?? 'Erreur inconnue';
            return redirect('/ko')->with('error', 'Erreur lors de l\'ajout du suivi : ' . $errorMessage);
        }
    }

    // Afficher le formulaire d'édition pour un suivi spécifique
    public function edit($id)
    {
        // Appel à l'API pour récupérer les détails du suivi
        $response = Http::get("http://localhost:8081/api/v1/trackings/{$id}");

        // Vérifier si la réponse est correcte
        if ($response->successful()) {
            $suivi = $response->json();  // Récupère les données du suivi
            $vehicules = Http::get('http://localhost:8081/api/v1/vehicules')->json();
            $chauffeurs = Http::get('http://localhost:8081/api/v1/chauffeurs')->json();
            return view('edit-suivi', compact('suivi', 'vehicules', 'chauffeurs'));  // Retourne la vue d'édition avec les données
        } else {
            return redirect('/suivis')->with('error', 'Suivi introuvable');
        }
    }

    // Mettre à jour un suivi spécifique via l'API
    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'idvehicule' => 'required|exists:vehicules,id',
            'idchauffeur' => 'required|exists:chauffeurs,id',
            'longitude' => 'required|numeric',
            'altitude' => 'required|numeric',
            'trajet' => 'required|string|max:255',
            'date_heure' => 'required|date',
        ]);

        // Données à envoyer pour la mise à jour
        $data = [
            'idvehicule' => $validated['idvehicule'],
            'idchauffeur' => $validated['idchauffeur'],
            'longitude' => $validated['longitude'],
            'altitude' => $validated['altitude'],
            'trajet' => $validated['trajet'],
            'date_heure' => $validated['date_heure'],
        ];

        // Appel à l'API pour mettre à jour le suivi
        $response = Http::put("http://localhost:8081/api/v1/trackings/{$id}", $data);

        // Vérifier si la mise à jour a été effectuée avec succès
        if ($response->successful()) {
            return redirect('/suivis')->with('success', 'Suivi modifié avec succès');
        } else {
            return redirect('/suivis')->with('error', 'Erreur lors de la modification du suivi');
        }
    }

    // Supprimer un suivi spécifique
    public function destroy($id)
    {
        // Appel à l'API pour supprimer le suivi
        $response = Http::delete("http://localhost:8081/api/v1/trackings/{$id}");

        // Vérifier si la suppression a réussi
        if ($response->successful()) {
            return redirect('/suivis')->with('success', 'Suivi supprimé avec succès');
        } else {
            // Afficher l'erreur exacte dans les logs
            \Log::error("Erreur API lors de la suppression du suivi {$id}", [
                'response' => $response->body(),
                'status_code' => $response->status()
            ]);

            // Afficher un message d'erreur plus détaillé pour l'utilisateur
            $errorMessage = $response->json()['message'] ?? 'Erreur inconnue';
            return redirect('/suivis')->with('error', 'Erreur lors de la suppression du suivi : ' . $errorMessage);
        }
    }

    public function location($id)
    {
        // Appel à l'API pour récupérer les détails du suivi du véhicule
        $response = Http::get("http://localhost:8081/api/v1/trackings/{$id}");

        // Vérifier si la réponse est réussie
        if ($response->successful()) {
            $tracking = $response->json();  // Récupérer les données du suivi du véhicule
            return view('location', compact('tracking'));
        } else {
            return redirect('/liste/suivi')->with('error', 'Erreur lors de la récupération de la localisation du véhicule');
        }
    }
}
