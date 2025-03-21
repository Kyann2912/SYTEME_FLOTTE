<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TrajetController extends Controller
{
    // Afficher la liste des trajets
    public function index()
    {
        // Appel à l'API Spring Boot pour récupérer la liste des trajets
        $response = Http::get('http://localhost:8081/api/trajets');
        
        if ($response->successful()) {
            $trajets = $response->json();  // Récupérer les données des trajets
            return view('liste_trajet', compact('trajets'));
        } else {
            return redirect('/trajets')->with('error', 'Erreur lors de la récupération des trajets.');
        }
    }

    // Formulaire de création d'un trajet
    public function create()
    {
        // Récupérer la liste des chauffeurs
        $responseChauffeurs = Http::get('http://localhost:8081/api/chauffeurs');
        $chauffeurs = $responseChauffeurs->successful() ? $responseChauffeurs->json() : [];

        // Récupérer la liste des véhicules
        $responseVehicules = Http::get('http://localhost:8081/api/vehicules');
        $vehicules = $responseVehicules->successful() ? $responseVehicules->json() : [];

        return view('trajet', compact('chauffeurs', 'vehicules'));
    }

    // Ajouter un trajet via l'API
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'date' => 'required|date',
            'idchauffeur' => 'required|exists:chauffeur,id',
            'idvehicule' => 'required|exists:vehicule,id',
        ]);
    
        // Données à envoyer à l'API pour la création du trajet
        $data = [
            'nom' => $validated['nom'],
            'distance' => $validated['distance'],
            'date' => $validated['date'],
            'idchauffeur' => $validated['idchauffeur'],
            'idvehicule' => $validated['idvehicule'],
        ];
    
        // Appel à l'API Spring Boot pour ajouter un trajet
        $response = Http::post('http://localhost:8081/api/trajets', $data);
    
        if ($response->successful()) {
            return redirect('/trajets')->with('ajout', 'Trajet ajouté avec succès!');
        } else {
            $errorMessage = $response->json()['message'] ?? 'Erreur inconnue';
            return redirect('/trajets')->with('error', 'Erreur lors de l\'ajout du trajet : ' . $errorMessage);
        }
    }

    // Formulaire d'édition pour un trajet spécifique
    public function edit($id)
    {
        // Appel à l'API pour récupérer les détails du trajet
        $response = Http::get("http://localhost:8081/api/trajets/{$id}");
        
        if ($response->successful()) {
            $trajet = $response->json();  // Récupère les données du trajet
            // Récupérer la liste des chauffeurs
            $responseChauffeurs = Http::get('http://localhost:8081/api/chauffeurs');
            $chauffeurs = $responseChauffeurs->successful() ? $responseChauffeurs->json() : [];

            // Récupérer la liste des véhicules
            $responseVehicules = Http::get('http://localhost:8081/api/vehicules');
            $vehicules = $responseVehicules->successful() ? $responseVehicules->json() : [];

            return view('edit_trajet', compact('trajet', 'chauffeurs', 'vehicules'));
        } else {
            return redirect('/trajets')->with('error', 'Trajet introuvable');
        }
    }

    // Mettre à jour un trajet via l'API
    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'date' => 'required|date',
            'idchauffeur' => 'required|exists:chauffeur,id',
            'idvehicule' => 'required|exists:vehicule,id',
        ]);

        // Données à envoyer à l'API pour la mise à jour du trajet
        $data = [
            'nom' => $validated['nom'],
            'distance' => $validated['distance'],
            'date' => $validated['date'],
            'idchauffeur' => $validated['idchauffeur'],
            'idvehicule' => $validated['idvehicule'],
        ];

        // Appel à l'API Spring Boot pour mettre à jour le trajet
        $response = Http::put("http://localhost:8081/api/trajets/{$id}", $data);
        
        if ($response->successful()) {
            return redirect('/trajets')->with('success', 'Trajet modifié avec succès');
        } else {
            return redirect('/trajets')->with('error', 'Erreur lors de la modification du trajet');
        }
    }

    // Supprimer un trajet spécifique
    public function destroy($id)
    {
        // Appel à l'API pour supprimer le trajet
        $response = Http::delete("http://localhost:8081/api/trajets/{$id}");

        if ($response->successful()) {
            return redirect('/trajets')->with('success', 'Trajet supprimé avec succès');
        } else {
            $errorMessage = $response->json()['message'] ?? 'Erreur inconnue';
            return redirect('/trajets')->with('error', 'Erreur lors de la suppression du trajet : ' . $errorMessage);
        }
    }
}
