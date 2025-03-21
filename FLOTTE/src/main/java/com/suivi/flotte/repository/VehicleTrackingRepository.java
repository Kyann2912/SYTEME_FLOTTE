package com.suivi.flotte.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import com.suivi.flotte.model.VehicleTracking;

@Repository
public interface VehicleTrackingRepository extends JpaRepository<VehicleTracking, Long> {
    // Vous pouvez ajouter des méthodes personnalisées si nécessaire
}