package com.suivi.flotte.repository;

import com.suivi.flotte.model.Vehicule;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface VehiculeRepository extends JpaRepository<Vehicule, Long> {
    // Aucun code supplémentaire nécessaire, JpaRepository fournit les méthodes de base
}
