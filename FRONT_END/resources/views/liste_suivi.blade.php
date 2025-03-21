<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Suivis de Véhicules</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9179c9d0f1.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="A mt-5 mb-4">
            <h1 class="text-center text-primary">LISTE DES SUIVIS DE VÉHICULES</h1>
            <hr>

            <!-- Section d'actions -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="/suivis/create" class="btn btn-success">AJOUTER UN SUIVI</a>
                <a href="/tableau" class="btn btn-warning">DASHBOARD</a>
            </div>

            <!-- Notifications de session -->
            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
            @endif
            @if(session('ajout'))
                <div class="alert alert-success" role="alert">{{ session('ajout') }}</div>
            @endif
            @if(session('a'))
                <div class="alert alert-success" role="alert">{{ session('a') }}</div>
            @endif
            @if(session('b'))
                <div class="alert alert-danger" role="alert">{{ session('b') }}</div>
            @endif

            <!-- Tableau des suivis de véhicules -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Immatriculation</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>Trajet</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trackings as $tracking)
                        <tr>
                            <td>{{ $tracking['id'] }}</td>
                            <td>{{ $tracking['immatriculation'] }}</td>
                            <td>{{ $tracking['longitude'] }} ° N</td>
                            <td>{{ $tracking['altitude'] }} ° W</td>
                            <td>{{ $tracking['trajet'] }}</td>
                            <td>
                                <!-- Lien vers la page de localisation avec l'ID du suivi -->
                                <a href="{{ route('suivis.location', ['id' => $tracking['id']]) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Localiser le véhicule">
                                    <i class="fas fa-map-marker-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fc;
    }

    .A {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .A h1 {
        font-family: 'Times New Roman', serif;
        font-size: 28px;
        font-weight: bold;
        color: rgb(4, 238, 234);
        text-align: center;
    }

    .A .btn {
        font-family: 'Arial', sans-serif;
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .A .btn:hover {
        opacity: 0.8;
    }

    .A .btn-success {
        background-color: #28a745;
        border: 1px solid #28a745;
    }

    .A .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .A .btn-warning {
        background-color: #ffc107;
        border: 1px solid #ffc107;
    }

    .A .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }

    .A .btn-primary {
        background-color: #007bff;
        border: 1px solid #007bff;
    }

    .A .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .table {
        margin-top: 30px;
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px 15px;
        text-align: left;
        font-size: 16px;
    }

    .table th {
        background-color: #f8f9fa;
        color: #343a40;
        font-weight: bold;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tbody tr:hover {
        background-color: #e9ecef;
    }

    .table-responsive {
        max-height: 500px;
        overflow-y: auto;
    }

    @media (max-width: 768px) {
        .A {
            padding: 20px;
        }

        .A h1 {
            font-size: 24px;
            text-align: center;
        }

        .table th, .table td {
            font-size: 14px;
        }

        .form-control {
            width: 200px;
        }
    }
</style>

</html>
