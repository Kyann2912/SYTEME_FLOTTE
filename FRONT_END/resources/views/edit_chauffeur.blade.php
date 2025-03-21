<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Chauffeur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9179c9d0f1.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-between mt-5">
            <!-- Formulaire de modification d'un chauffeur -->
            <div class="col-md-6 p-4" style="background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                <h1 style="color: #007BFF;"><i class="fas fa-user-edit" style="color: #007BFF;"></i> Modifier un Chauffeur</h1>
                <form action="{{ route('chauffeurs.update', $chauffeur['id']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Champ Nom -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" value="{{ $chauffeur['nom'] }}" required>
                    </div>

                    <!-- Champ Prénoms -->
                    <div class="mb-3">
                        <label for="prenoms" class="form-label">Prénoms</label>
                        <input type="text" class="form-control" name="prenoms" id="prenoms" value="{{ $chauffeur['prenoms'] }}" required>
                    </div>

                    <!-- Champ Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $chauffeur['email'] }}" required>
                    </div>

                    <!-- Champ Contact -->
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" name="contact" id="contact" value="{{ $chauffeur['contact'] }}" required>
                    </div>

                    <!-- Champ Adresse -->
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <textarea class="form-control" name="adresse" id="adresse" rows="4" required>{{ $chauffeur['adresse'] }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Mettre à jour le chauffeur</button>
                </form>
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

    @media (max-width: 768px) {
        .col-md-6 {
            width: 100%;
        }
    }
</style>
</html>
