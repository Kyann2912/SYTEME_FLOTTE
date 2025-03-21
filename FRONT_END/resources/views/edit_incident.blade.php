<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Incident</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9179c9d0f1.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-between mt-5">
            <!-- Formulaire de modification d'incident -->
            <div class="col-md-5 p-4" style="background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                <h1 style="color: #007BFF;"><i class="fas fa-exclamation-triangle" style="color: #007BFF;"></i> Modifier un Incident</h1>
                
                <!-- Formulaire avec méthode PUT pour la modification -->
                <form action="/incidents/{{ $incident['id'] }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Utilisation de la méthode PUT pour indiquer une mise à jour -->

                    <!-- Champ Type -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Type d'incident</label>
                        <input type="text" class="form-control" name="type" id="type" value="{{ old('type', $incident['type']) }}" required>
                    </div>

                    <!-- Champ Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4" required>{{ old('description', $incident['description']) }}</textarea>
                    </div>

                    <!-- Champ Date -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Date de l'incident</label>
                        <input type="date" class="form-control" name="date" id="date" value="{{ old('date', \Carbon\Carbon::parse($incident['date'])->format('Y-m-d')) }}" required>
                    </div>

                    <!-- Sélection du Véhicule -->
                    <div class="mb-3">
                        <label for="idVehicule" class="form-label">Sélectionner un Véhicule</label>
                        <select class="form-control" name="idVehicule" id="idVehicule" required>
                            <option value="" disabled>Sélectionner un véhicule</option>
                            @foreach($vehicules as $vehicule)
                                <option value="{{ $vehicule['id'] }}" {{ old('idVehicule', $incident['idVehicule']) == $vehicule['id'] ? 'selected' : '' }}>
                                    {{ $vehicule['immatriculation'] }} - {{ $vehicule['model'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Modifier l'incident</button>
                </form>
            </div>

            <!-- Section de notification des erreurs -->
            <div class="col-md-5 p-4" style="background-color: #fff3cd; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); text-align: center;">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @elseif(session('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif
                <br>
                <p style="font-size: 18px;">Vous voulez consulter la liste des incidents ?</p>
                <a href="/incidents" class="btn btn-info">Consulter</a>
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

    .col-md-5 {
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

        .col-md-5 {
            width: 100%;
            margin-bottom: 20px;
        }
    }
</style>

</html>
