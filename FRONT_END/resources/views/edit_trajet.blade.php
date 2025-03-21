<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Trajet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9179c9d0f1.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-between mt-5">
            <!-- Formulaire de modification de trajet -->
            <div class="col-md-6 p-4" style="background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                <h1 style="color: #007BFF;"><i class="fas fa-route" style="color: #007BFF;"></i> Modifier un Trajet</h1>

                <!-- Notifications de session -->
                @if(session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif

                <!-- Formulaire de modification -->
                <form action="{{ route('trajets.update', $trajet['id']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Champ ID (en lecture seule) -->
                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" name="id" class="form-control" id="id" value="{{ old('id', $trajet['id']) }}" disabled>
                    </div>

                    <!-- Champ Nom -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom du trajet</label>
                        <input type="text" name="nom" class="form-control" id="nom" value="{{ old('nom', $trajet['nom']) }}" required>
                    </div>

                    <!-- Champ Distance -->
                    <div class="mb-3">
                        <label for="distance" class="form-label">Distance (en km)</label>
                        <input type="number" name="distance" class="form-control" id="distance" value="{{ old('distance', $trajet['distance']) }}" required min="1">
                    </div>

                    <!-- Sélectionner Chauffeur -->
                    <div class="mb-3">
                        <label for="idchauffeur" class="form-label">Chauffeur</label>
                        <select name="idchauffeur" class="form-control" id="idchauffeur" required>
                            <option value="">Sélectionnez un chauffeur</option>
                            @foreach($chauffeurs as $chauffeur)
                                <option value="{{ $chauffeur['id'] }}" {{ $trajet['idchauffeur'] == $chauffeur['id'] ? 'selected' : '' }}>
                                    {{ $chauffeur['nom'] }} {{ $chauffeur['prenoms'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sélectionner Véhicule -->
                    <div class="mb-3">
                        <label for="idvehicule" class="form-label">Véhicule</label>
                        <select name="idvehicule" class="form-control" id="idvehicule" required>
                            <option value="">Sélectionnez un véhicule</option>
                            @foreach($vehicules as $vehicule)
                                <option value="{{ $vehicule['id'] }}" {{ $trajet['idvehicule'] == $vehicule['id'] ? 'selected' : '' }}>
                                    {{ $vehicule['immatriculation'] }} {{ $vehicule['model'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Modifier le trajet</button>
                </form>
            </div>

            <!-- Section de notification de redirection -->
            <div class="col-md-5 p-4" style="background-color: #fff3cd; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); text-align: center;">
                <p style="font-size: 18px;">Vous voulez consulter la liste des trajets ?</p>
                <a href="/trajets" class="btn btn-info">Consulter</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fc;
    }

    .container-fluid {
        padding: 40px;
    }

    .row {
        display: flex;
        justify-content: space-between;
    }

    .col-md-6 {
        padding: 20px;
        border-radius: 10px;
    }

    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-bottom: 15px;
        padding: 10px;
    }

    .form-control:focus {
        border-color: #007BFF;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.7);
    }

    .btn {
        padding: 12px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 8px;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-info {
        background-color: #17a2b8;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 8px;
        transition: background-color 0.3s;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    @media (max-width: 768px) {
        .row {
            flex-direction: column;
        }

        .col-md-6 {
            width: 100%;
            margin-bottom: 20px;
        }
    }
</style>
</html>
