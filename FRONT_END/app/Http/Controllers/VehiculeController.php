<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\chauffeur; 
use App\Models\incident; 
use App\Models\trajet;  
use App\Models\vehicule;  
use App\Models\suivi;  



class VehiculeController extends Controller
{
    // Afficher le formulaire de création d'un véhicule
    public function create()
    {
        return view('create_vehicule');
    }

    // Ajouter un véhicule via l'API
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'immatriculation' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'couleur' => 'required|string|max:30',
            'nbrePassager' => 'required|integer',
        ]);

        // Données à envoyer à l'API
        $data = [
            'immatriculation' => $validated['immatriculation'],
            'model' => $validated['model'],
            'couleur' => $validated['couleur'],
            'nbrePassager' => $validated['nbrePassager'],
        ];

        // Appel à l'API Spring Boot pour ajouter un véhicule

        $response = Http::post('http://localhost:8081/api/vehicules', $data);

        if ($response->successful()) {
            return redirect('liste/vehicules')->with('ajout', 'Véhicule ajouté avec succès!');
        } else {

            $errorMessage = $response->json()['message'] ?? 'Erreur inconnue';
            return redirect()->route('vehicules.create')->with('error', 'Erreur lors de l\'ajout du véhicule : ' . $errorMessage);
        }
    }

    // Afficher la liste des véhicules
    public function index()
    {
        // Appel à l'API Spring Boot pour récupérer la liste des véhicules
        $response = Http::get('http://localhost:8081/api/vehicules');
        

        if ($response->successful()) {
            $vehicules = $response->json();  // Récupérer les données des véhicules
            return view('index', compact('vehicules'));
        } else {
            return redirect('/liste/vehicules')->with('error', 'Erreur lors de la récupération des véhicules.');
        }
    }

    // Afficher le formulaire d'édition pour un véhicule spécifique
// Afficher le formulaire d'édition pour un véhicule spécifique
public function edit($id)
{
    // Appel à l'API pour récupérer les détails du véhicule
    $response = Http::get("http://localhost:8081/api/vehicules/{$id}");

    // Vérifier si la réponse est correcte
    if ($response->successful()) {
        $vehicule = $response->json();  // Récupère les données du véhicule
        return view('edit_vehicule', compact('vehicule'));  // Retourne la vue d'édition avec les données
    } else {
        return redirect('/liste/vehicules')->with('error', 'Véhicule introuvable');
    }
}


    // Mettre à jour un véhicule spécifique via l'API
// Mettre à jour un véhicule spécifique via l'API
public function update(Request $request, $id)
{
    // Validation des données
    $validated = $request->validate([
        'immatriculation' => 'required|string|max:50',
        'model' => 'required|string|max:50',
        'couleur' => 'required|string|max:30',
        'nbrePassager' => 'required|integer',
    ]);

    // Appel à l'API pour mettre à jour le véhicule
    $response = Http::put("http://localhost:8081/api/vehicules/{$id}", $validated);

    // Vérifier si la mise à jour a été effectuée avec succès
    if ($response->successful()) {
        return redirect('/liste/vehicules')->with('success', 'Véhicule modifié avec succès');
    } else {
        return redirect('/liste/vehicules')->with('error', 'Erreur lors de la modification du véhicule');
    }
}


    public function destroy($id)
    {
        // Appel à l'API pour supprimer le véhicule
        $response = Http::delete("http://localhost:8081/api/vehicules/{$id}");
    
        // Vérifier si la suppression a réussi
        if ($response->successful()) {
            return redirect('/liste/vehicules')->with('a', 'Véhicule supprimé avec succès');
        } else {
            // Afficher l'erreur exacte dans les logs
            \Log::error("Erreur API lors de la suppression du véhicule {$id}", [
                'response' => $response->body(),
                'status_code' => $response->status()
            ]);
    
            // Afficher un message d'erreur plus détaillé pour l'utilisateur
            $errorMessage = $response->json()['message'] ?? 'Erreur inconnue';
            return redirect('/liste/vehicules')->with('b', 'Erreur lors de la suppression du véhicule : ' . $errorMessage);
        }
    }
    

    public function tableau (){

        $chauffeur = chauffeur::count();
        $incident =  incident::count();
        $trajet = trajet::count();
        $vehicule =  vehicule::count();
        $suivi = suivi::count();
        $data = [
            'labels'=> ['chauffeur','incident','trajet','vehicule','suivi'],
            'values'=> [$chauffeur,$incident,$trajet,$vehicule,$suivi]
        ];
        return view('tableau',compact('data','chauffeur','incident','trajet','vehicule','suivi'));
    }


    public function incident(){
        return view('incident');
    }


    public function ajout_incident(Request $request)
    {
        // Validation des données
        $validated = $request->validate([


            'id' => 'required|integer|max:50',
            'description' => 'required|string',
            'type' => 'required|string|max:50',

        ]);

        // Données à envoyer à l'API
        $data = [
            'id'=>$validated['id'],
            'description' => $validated['description'],
            'type' => $validated['type'],

        ];

        // Appel à l'API Spring Boot pour ajouter un véhicule
        $response = Http::post('http://localhost:8081/api/incidents', $data);

        // Vérifier si la réponse est réussie
        if ($response->successful()) {
            return redirect('liste/vehicules')->with('yann', 'Incident ajouté avec succès!');
        } else {
            // Récupérer l'erreur et afficher un message
            $errorMessage = $response->json()['message'] ?? 'Erreur inconnue';
            return redirect('liste/vehicules')->with('kouakou', 'Erreur lors de l\'ajout de l\'incident : ' . $errorMessage);
        }
    }


    public function connexion(){
        return view('connexion');
    }



    public function franck()
    {
        return view('create');
    }

    // Enregistrer les données via l'API Spring Boot
    // Enregistrer les données via l'API Spring Boot
    // Enregistrer les données via l'API Spring Boot
    public function ephrem(Request $request)
    {
        // Validation des données
        $request->validate([
            'immatriculation' => 'required|string|max:255',
            'longitude' => 'required|numeric',
            'altitude' => 'required|numeric',
            'trajet' => 'required|string|max:255',
        ]);

        // Données à envoyer à l'API
        $data = [
            'immatriculation' => $request->immatriculation,
            'longitude' => $request->longitude,
            'altitude' => $request->altitude,
            'trajet' => $request->trajet,
        ];

        // Affiche les données pour vérifier leur format
        \Log::info('Données envoyées : ' . json_encode($data));

        // URL de l'API Spring Boot
        $url = 'http://localhost:8081/api/v1/trackings';

        // Envoi de la requête POST à l'API Spring Boot avec en-tête Content-Type: application/json
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, $data);

        // Vérification de la réponse de l'API
        if ($response->successful()) {
            return redirect()->route('trackings.create')->with('success', 'Suivi ajouté avec succès');
        } else {
            // Log de la réponse de l'API pour déboguer
            \Log::error('API Response: ' . $response->body());

            // En cas d'erreur, afficher un message d'erreur détaillé
            return redirect()->route('trackings.create')->with('error', 'Erreur lors de l\'ajout du suivi: ' . $response->body());
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password', 'role');

        // Appel à l'API Spring Boot pour l'authentification
        $response = Http::asForm()->post('http://localhost:8080/auth/login', $credentials);

        if ($response->successful()) {
            return redirect('/tableau'); // ou où vous voulez rediriger
        } else {
            return back()->withErrors(['message' => 'Invalid credentials.']);
        }
    }

    public function checkCredentials(Request $request)
    {
        // Valider les champs de l'input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        // Vérification de l'email et du mot de passe
        if ($validated['email'] == 'kyann372@gmail.com' && $validated['password'] == '0000') {
            // Si les informations sont correctes, rediriger vers le tableau de bord
            return redirect('/tableau');
        } else {
            // Si les identifiants sont incorrects, rediriger avec un message d'erreur
            return redirect('/connexion')->with('email' ,'Identifiants incorrects.');
        }
    }


    
    
}
