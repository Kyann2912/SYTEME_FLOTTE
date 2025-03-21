<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tableau de Bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9179c9d0f1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background-color: #f4f6f9;
        opacity: 0;
        animation: fadeIn 0.2s forwards;
      }

      .container {
        display: flex;
        flex-wrap: wrap;
        height: 100vh;
      }

      .sidebar {
        background-color: #2c3e50;
        color: white;
        width: 250px;
        padding: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        position: fixed;
        height: 100%;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        opacity: 0;
        animation: slideIn 1.5s ease-out forwards;
        animation-delay: 0.5s;
      }

      .sidebar h1 {
        font-size: 24px;
        margin-bottom: 15px;
        color: #ecf0f1;
      }

      .sidebar a {
        display: block;
        color: #ecf0f1;
        text-decoration: none;
        padding: 10px 20px;
        margin-bottom: 8px;
        border-radius: 5px;
        transition: background-color 0.3s;
      }

      .sidebar a:hover {
        background-color: #34495e;
      }

      .content {
        margin-left: 250px;
        flex: 1;
        padding: 30px;
        overflow-y: auto;
        opacity: 0;
        animation: slideIn 1.5s ease-out forwards;
        animation-delay: 1s;
      }

      .header h1 {
        margin-bottom: 5px;
      }

      #map {
        height: 500px;
        width: 100%;
        margin-bottom: 20px;
      }

      .logout {
        text-align: center;
        padding: 10px 0;
        margin-top: auto;
      }

      .logout a {
        background-color: #e74c3c;
        color: white;
        padding: 12px 25px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s, transform 0.3s;
      }

      .logout a:hover {
        background-color: #c0392b;
        transform: scale(1.05);
      }

      .stats {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 30px;
      }

      .stat-box {
        background-color: #fff;
        padding: 20px;
        width: 18%;
        text-align: center;
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .stat-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
      }

      .stat-box h2 {
        font-size: 48px;
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 10px;
      }

      .stat-box p {
        font-size: 20px;
        color: #7f8c8d;
      }

      .stat-box i {
        font-size: 30px;
        color: #2c3e50;
        margin-bottom: 10px;
      }

      .graph-container {
        margin-top: 0;
      }

      @keyframes fadeIn {
        0% {
          opacity: 0;
        }
        100% {
          opacity: 1;
        }
      }

      @keyframes slideIn {
        0% {
          opacity: 0;
          transform: translateX(-50px);
        }
        100% {
          opacity: 1;
          transform: translateX(0);
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <!-- Sidebar -->
      <div class="sidebar">
        <p style="font-size: 30px; color: #ecf0f1; margin-left:10px;">
          <i class="fas fa-user-cog" style="margin-right: 15px; font-size: 40px;"></i>Administrateur
        </p>
        <br>
        <a href="/chauffeurs"><i class="fas fa-user-tie" style="margin-right: 15px;"></i>Gestion des Chauffeurs</a>
        <a href="/liste/vehicules"><i class="fas fa-car"></i> Gestion des Véhicules</a>
        <a href="/incidents"><i class="fas fa-exclamation-circle"></i> Gestion des Incidents</a>
        <a href="/ko"><i class="fas fa-clipboard"></i> Gestion des Suivis</a>
        <a href="/trajets"><i class="fas fa-route"></i> Gestion des Trajets</a>

        <!-- Button de déconnexion en bas -->
        <div class="logout">
          <a href="/connexion">
            <i class="fas fa-sign-out-alt" style="font-size: 20px;"></i> DECONNEXION
          </a>
        </div>
      </div>

      <!-- Content -->
      <div class="content">
        <div class="header">
          <h1>Bienvenue sur  tableau de bord</h1>
        </div>
        <br><br>

        <div class="stats" id="stats">
          <div class="stat-box">
            <i class="fas fa-users"></i>
            <h2>{{ $chauffeur }}</h2>
            <p>Chauffeurs</p>
          </div>
          <div class="stat-box">
            <i class="fas fa-car"></i>
            <h2>{{ $vehicule }}</h2>
            <p>Véhicules</p>
          </div>
          <div class="stat-box">
            <i class="fas fa-route"></i>
            <h2>{{ $trajet }}</h2>
            <p>Trajets</p>
          </div>
          <div class="stat-box">
            <i class="fas fa-clipboard"></i>
            <h2>{{ $suivi }}</h2>
            <p>Suivis</p>
          </div>
          <div class="stat-box">
            <i class="fas fa-exclamation-circle"></i>
            <h2>{{ $incident }}</h2>
            <p>Incidents</p>
          </div>
        </div>
        
        <!-- Graphiques -->
        <div class="row graph-container">
          <!-- Diagramme circulaire -->
          <div class="col-md-6">
            <canvas id="pieChart"></canvas>
          </div>

          <!-- Diagramme en barres -->
          <div class="col-md-6">
            <canvas id="barChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <script>
      const data = @json($data);

      const pieChartColors = ['#28a745', '#e74c3c', '#f1c40f', '#3498db', '#8e44ad'];

      const pieCtx = document.getElementById('pieChart').getContext('2d');
      new Chart(pieCtx, {
        type: 'pie',
        data: {
          labels: data.labels,
          datasets: [{
            data: data.values,
            backgroundColor: pieChartColors,
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { position: 'top' },
            tooltip: {
              callbacks: {
                label: function(tooltipItem) {
                  return tooltipItem.label + ': ' + tooltipItem.raw;
                }
              }
            }
          },
          animation: { duration: 1500, easing: 'easeOutQuart' }
        }
      });

      const barCtx = document.getElementById('barChart').getContext('2d');
      new Chart(barCtx, {
        type: 'bar',
        data: {
          labels: data.labels,
          datasets: [{
            label: 'Quantité',
            data: data.values,
            backgroundColor: '#3498db',
            borderColor: '#3498db',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          scales: { y: { beginAtZero: true } },
          animation: { duration: 1500, easing: 'easeOutQuart' }
        }
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
