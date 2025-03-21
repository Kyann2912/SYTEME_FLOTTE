<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;



class IncidentController extends Controller
{
    
    public function index()
    {
        $client = new Client();
        
        // Appel à l'API Spring Boot pour récupérer tous les incidents
        $response = $client->get('http://localhost:8081/api/incidents');
        
        // Décoder les données JSON retournées
        $incidents = json_decode($response->getBody(), true);
        
        // Formater les dates des incidents
        foreach ($incidents as &$incident) {
            // Utiliser Carbon pour formater la date au format YYYY-MM-DD
            if (isset($incident['date'])) {
                $incident['date'] = Carbon::parse($incident['date'])->format('Y-m-d');
            }
        }
    
        // Passer les incidents à la vue
        return view('affiche', ['incidents' => $incidents]);
    }
    

    // Afficher un incident spécifique
    public function show($id)
    {
        $client = new Client();
        
        // Appel à l'API Spring Boot pour récupérer un incident spécifique
        $response = $client->get("http://localhost:8081/api/incidents/{$id}");
        
        // Décoder les données JSON retournées
        $incident = json_decode($response->getBody(), true);
        
        return view('incidents.show', ['incident' => $incident]);
    }

    // Ajouter un incident
    public function store(Request $request)
    {
        $client = new Client();
        
        // Envoi d'une requête POST à l'API Spring Boot pour ajouter un incident
        $response = $client->post('http://localhost:8081/api/incidents', [
            'json' => [
                'type' => $request->input('type'),
                'description' => $request->input('description'),
                'date' => $request->input('date'),
                'idVehicule' => $request->input('idVehicule')

            ]
        ]);
        
        return redirect('/incidents')->with('success', 'Incident ajouté avec succès!');
    }

    // Mettre à jour un incident
    public function update(Request $request, $id)
    {
        $client = new Client();
        
        // Envoi d'une requête PUT à l'API Spring Boot pour mettre à jour un incident
        $response = $client->put("http://localhost:8081/api/incidents/{$id}", [
            'json' => [
                'type' => $request->input('type'),
                'description' => $request->input('description'),
                'date' => $request->input('date'),
                'idVehicule' => $request->input('idVehicule')

            ]
        ]);
        
        return redirect('/incidents')->with('success', 'Incident mis à jour avec succès !');
    }

    // Supprimer un incident
    public function destroy($id)
    {
        $client = new Client();
        
        // Envoi de la requête DELETE à l'API Spring Boot pour supprimer un incident
        $response = $client->delete("http://localhost:8081/api/incidents/{$id}");

        return redirect('/incidents')->with('success', 'Incident supprimé avec succès!');
        
    }


    public function ajout_incident(){
        return view('incident');
    }

    public function edit($id)
    {
        // Appel à l'API pour récupérer les détails de l'incident
        $incidentResponse = Http::get("http://localhost:8081/api/incidents/{$id}");
    
        // Vérifier si la réponse pour l'incident est correcte
        if ($incidentResponse->successful()) {
            $incident = $incidentResponse->json();  // Récupère les données de l'incident
    
            // Appel à l'API pour récupérer la liste des véhicules
            $vehiclesResponse = Http::get("http://localhost:8081/api/vehicules");  // URL pour récupérer tous les véhicules
    
            // Vérifier si la réponse pour les véhicules est correcte
            if ($vehiclesResponse->successful()) {
                $vehicules = $vehiclesResponse->json();  // Récupère la liste des véhicules
                return view('edit_incident', compact('incident', 'vehicules'));  // Retourne la vue d'édition avec les données de l'incident et les véhicules
            } else {
                return redirect('/incidents')->with('error', 'Erreur lors de la récupération des véhicules');
            }
        } else {
            return redirect('/incidents')->with('error', 'Incident introuvable');
        }
    }
    
}
