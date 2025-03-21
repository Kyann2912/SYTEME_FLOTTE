package com.suivi.flotte.repository;

import com.suivi.flotte.model.Trajet;  // Importation du modèle Trajet
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface TrajetRepository extends JpaRepository<Trajet, Long> {
    // Ici, vous pouvez ajouter des méthodes personnalisées pour la gestion des trajets si nécessaire
}
