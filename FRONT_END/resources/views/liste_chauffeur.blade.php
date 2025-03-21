<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Chauffeurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9179c9d0f1.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="A mt-5 mb-4">
            <h1 class="text-center text-primary">LISTE DES CHAUFFEURS</h1>
            <hr>

            <!-- Section d'actions -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="/chauffeurs/create" class="btn btn-success">AJOUTER UN CHAUFFEUR</a>
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

            <!-- Tableau des chauffeurs -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénoms</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Adresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $num = 1; @endphp <!-- Initialisation du compteur -->
                        @foreach($chauffeurs as $chauffeur)
                        <tr>
                            <td>{{ $chauffeur['id'] }}</td>
                            <td>{{ $chauffeur['nom'] }}</td>
                            <td>{{ $chauffeur['prenoms'] }}</td>
                            <td>{{ $chauffeur['email'] }}</td>
                            <td>{{ $chauffeur['contact'] }}</td>
                            <td>{{ $chauffeur['adresse'] }}</td>

                            <td>
                                <!-- Formulaire de modification -->
                                <form action="{{ route('chauffeurs.edit', $chauffeur['id']) }}" method="GET" style="display:inline;">
                                    <button type="submit" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier le chauffeur">
                                        <i class="fas fa-edit"></i> Modifier
                                    </button>
                                </form>

                                <!-- Formulaire de suppression -->
                                <form action="{{ route('chauffeurs.destroy', $chauffeur['id']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer le chauffeur">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
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

    .A .btn-info {
        background-color: #17a2b8;
        border: 1px solid #17a2b8;
    }

    .A .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }

    .A .btn-danger {
        background-color: #dc3545;
        border: 1px solid #dc3545;
    }

    .A .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
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
