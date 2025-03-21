<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localisation du Véhicule</title>

    <!-- Inclure la feuille de style de Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    
    <style>
        /* Police générale et marges */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }

        /* Mise en page de la page */
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 50px auto;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            animation: fadeIn 1s ease-out;
        }

        h1 {
            text-align: center;
            font-size: 2em;
            color: #005f73;
            margin-bottom: 20px;
        }

        .info {
            margin-top: 30px;
            padding: 20px;
            background-color: #e0f7fa;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.8s ease-in-out;
        }

        .info h3 {
            margin-top: 0;
            font-size: 1.5em;
            color: #00796b;
        }

        .info p {
            font-size: 1.2em;
            margin: 10px 0;
            color: #555;
        }

        /* Style de la carte */
        #map {
            height: 500px;
            width: 100%;
            border-radius: 12px;
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Animation d'apparition */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Animation de glissement de la boîte d'information */
        @keyframes slideIn {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(0); }
        }

        /* Style du bouton */
        .btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #00796b;
            color: white;
            font-size: 1.2em;
            text-align: center;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #004d40;
        }

        .btn:active {
            background-color: #00332a;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Localisation du Véhicule</h1>

    <!-- Carte -->
    <div id="map"></div>

    <!-- Informations du véhicule -->
    <div class="info">
        <h3>Informations du Véhicule</h3>
        <p><strong>ID:</strong> {{ $tracking['id'] }}</p>
        <p><strong>Longitude:</strong> {{ $tracking['longitude'] }}</p>
        <p><strong>Latitude:</strong> {{ $tracking['altitude'] }} m</p>
    </div>

    <!-- Bouton interactif -->
    <a href="/ko" class="btn"  style="text-decoration:none;">LISTE DES SUIVIS</a>
</div>

<!-- Inclure Leaflet.js -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    // Utilisez la longitude pour positionner le marqueur
    var longitude = {{ $tracking['longitude'] }};  // Utilisez longitude pour positionner le marqueur
    var latitude = 7.539989;  // Utilisation d'une latitude approximative pour la Côte d'Ivoire (ex: Abidjan)

    // Initialiser la carte et la centrer sur la position du véhicule
    var map = L.map('map').setView([latitude, longitude], 7);  // Centrer la carte sur le véhicule

    // Ajouter la couche de tuiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Ajouter un marqueur pour la position du véhicule
    var marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup("<b>Véhicule ID: {{ $tracking['id'] }}</b><br>Longitude: " + longitude + "<br>Altitude: {{ $tracking['altitude'] }} m")
        .openPopup();

    // Vous pouvez également ajouter un cercle de rayon autour de la position pour afficher une zone d'intérêt
    var circle = L.circle([latitude, longitude], {
        color: 'blue',
        fillColor: '#30a5e6',
        fillOpacity: 0.4,
        radius: 5000  // rayon en mètres
    }).addTo(map);

</script>

</body>
</html>
