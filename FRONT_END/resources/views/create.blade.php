<!-- resources/views/trackings/create.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un suivi</title>
</head>
<body>

    <h1>Ajouter un suivi de trajet</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif

    <form action="{{ route('trackings.store') }}" method="POST">
        @csrf
        <label for="immatriculation">Immatriculation :</label>
        <input type="text" name="immatriculation" required><br>

        <label for="longitude">Longitude :</label>
        <input type="text" name="longitude" required><br>

        <label for="altitude">Altitude :</label>
        <input type="text" name="altitude" required><br>

        <label for="trajet">Trajet :</label>
        <input type="text" name="trajet" required><br>

        <button type="submit">Ajouter</button>
    </form>

</body>
</html>
