<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Système de Suivi de Flotte pour une Entreprise Logistique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/9179c9d0f1.js" crossorigin="anonymous"></script>
  
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
      background: #f4f7fa;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-login {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 900px;  /* Réduction de la largeur du conteneur */
      height: 70%;
    }

    .gps-icon {
      background-color: #3498db;
      color: white;
      width: 300px;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      border-top-left-radius: 15px;
      border-bottom-left-radius: 15px;
    }

    .gps-icon i {
      font-size: 5rem;
    }

    .form-panel {
      width: 100%;
      max-width: 500px;  /* Limitation de la largeur du formulaire à 500px */
      padding: 40px;
      margin: 0 auto;
    }

    .form-title {
      font-size: 2rem;
      font-weight: 600;
      text-align: center;
      color: #333;
      margin-bottom: 25px;
    }

    .form-label {
      font-size: 1rem;
      font-weight: 600;
      color: #333;
    }

    .form-control, .form-select {
      border-radius: 50px;
      padding: 12px;
      font-size: 1rem;
      margin-top: 10px;
      border: 1px solid #ccc;
      transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
      border-color: #3498db;
      box-shadow: 0 0 5px rgba(52, 152, 219, 0.7);
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-icon {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #aaa;
    }

    .form-container {
      position: relative;
    }

    .password-container {
      position: relative;
    }

    .forgot-password {
      text-align: center;
      display: block;
      color: #3498db;
      font-weight: 600;
      margin-top: 10px;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }

    .submit-btn {
      background-color: #3498db;
      color: white;
      font-weight: bold;
      border: none;
      padding: 12px;
      border-radius: 50px;
      width: 100%;  /* Le bouton prend toute la largeur du formulaire */
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
      margin-top: 20px; /* Ajouter de l'espace au-dessus du bouton */
    }

    .submit-btn:hover {
      background-color: #2980b9;
    }

    .alert {
      font-size: 0.9rem;
      color: red;
      text-align: center;
      margin-top: 20px;
    }

  </style>
</head>

<body>

  <div class="container-login">
    <!-- GPS Icon Section (Left) -->
    <div class="gps-icon">
      <!-- Changement de l'icône par l'icône de localisation -->
      <i class="fas fa-map-marker-alt"></i>
    </div>

    <!-- Form Panel Section (Right) -->
    <div class="form-panel">
      <h1 class="form-title">Se connecter</h1>

      <!-- Affichage du message de succès -->
      @if(session('email'))
        <div class="alert alert-danger" role="alert">
          {{ session('email') }}
        </div>
      @endif

      <!-- Formulaire de connexion -->
      <form action="/ajouter/utilisateur" method="post">
        @csrf
        <!-- Champ Email -->
        <div class="form-group form-container">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control" name="email" id="email" placeholder="Entrez votre email">
        </div>

        <!-- Champ Rôle -->
        <div class="form-group">
          <label for="role" class="form-label">Rôle</label>
          <select class="form-select" name="role" id="role">
            <option value="admin">Admin</option>
            <option value="chauffeur">Chauffeur</option>
          </select>
        </div>

        <!-- Champ Mot de Passe -->
        <div class="form-group password-container">
          <label for="password" class="form-label">Mot de Passe</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe">
          <i class="fas fa-eye eye-icon" id="toggle-password"></i>
        </div>
        <input type="submit" class="submit-btn" value="Connexion" style="width:280px; margin-left:70px;">
      </form>
    </div>
  </div>

  <script>
    document.getElementById('toggle-password').addEventListener('click', function() {
      var passwordField = document.getElementById('password');
      var type = passwordField.type === 'password' ? 'text' : 'password';
      passwordField.type = type;
      this.classList.toggle('fa-eye-slash');
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
