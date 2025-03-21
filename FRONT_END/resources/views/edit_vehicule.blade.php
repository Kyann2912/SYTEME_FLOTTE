<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Véhicule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9179c9d0f1.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-between mt-5">
            <!-- Formulaire de modification de véhicule -->
            <div class="col-md-6 p-4" style="background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                <h1 style="color: #007BFF;"><i class="fas fa-car" style="color: #007BFF;"></i> Modifier un Véhicule</h1>

                <!-- Notifications de session -->
                @if(session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif

                <form action="{{ route('vehicules.update', $vehicule['id']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Champ ID -->
                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" name="id" class="form-control" id="id" value="{{ old('id', $vehicule['id']) }}" disabled>
                    </div>

                    <!-- Champ Immatriculation -->
                    <div class="mb-3">
                        <label for="immatriculation" class="form-label">Immatriculation</label>
                        <input type="text" name="immatriculation" class="form-control" id="immatriculation" value="{{ old('immatriculation', $vehicule['immatriculation']) }}" required>
                    </div>

                    <!-- Champ Modèle -->
                    <div class="mb-3">
                        <label for="model" class="form-label">Modèle</label>
                        <input type="text" name="model" class="form-control" id="model" value="{{ old('model', $vehicule['model']) }}" required>
                    </div>

                    <!-- Champ Couleur -->
                    <div class="mb-3">
                        <label for="couleur" class="form-label">Couleur</label>
                        <select class="form-control" name="couleur" id="couleur" required>
                            <option value="">Choisissez une couleur</option>
                            <option value="Rouge" {{ old('couleur', $vehicule['couleur']) == 'Rouge' ? 'selected' : '' }}>Rouge</option>
                            <option value="Bleu" {{ old('couleur', $vehicule['couleur']) == 'Bleu' ? 'selected' : '' }}>Bleu</option>
                            <option value="Vert" {{ old('couleur', $vehicule['couleur']) == 'Vert' ? 'selected' : '' }}>Vert</option>
                            <option value="Noir" {{ old('couleur', $vehicule['couleur']) == 'Noir' ? 'selected' : '' }}>Noir</option>
                            <option value="Blanc" {{ old('couleur', $vehicule['couleur']) == 'Blanc' ? 'selected' : '' }}>Blanc</option>
                            <option value="Gris" {{ old('couleur', $vehicule['couleur']) == 'Gris' ? 'selected' : '' }}>Gris</option>
                            <option value="Jaune" {{ old('couleur', $vehicule['couleur']) == 'Jaune' ? 'selected' : '' }}>Jaune</option>
                            <option value="Orange" {{ old('couleur', $vehicule['couleur']) == 'Orange' ? 'selected' : '' }}>Orange</option>
                            <option value="Violet" {{ old('couleur', $vehicule['couleur']) == 'Violet' ? 'selected' : '' }}>Violet</option>
                            <option value="Rose" {{ old('couleur', $vehicule['couleur']) == 'Rose' ? 'selected' : '' }}>Rose</option>
                        </select>
                    </div>

                    <!-- Champ Nombre de Passagers -->
                    <div class="mb-3">
                        <label for="nbrePassager" class="form-label">Nombre de Passagers</label>
                        <input type="number" name="nbrePassager" class="form-control" id="nbrePassager" value="{{ old('nbrePassager', $vehicule['nbrePassager']) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Mettre à jour le véhicule</button>
                </form>
            </div>

            <!-- Section de notification de redirection -->
            <div class="col-md-5 p-4" style="background-color: #fff3cd; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); text-align: center;">
                <p style="font-size: 18px;">Vous voulez consulter la liste des véhicules ?</p>
                <a href="/liste/vehicules" class="btn btn-info">Consulter</a>
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

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
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
        .col-md-6, .col-md-5 {
            width: 100%;
            margin-bottom: 20px;
        }
    }
</style>
</html>
