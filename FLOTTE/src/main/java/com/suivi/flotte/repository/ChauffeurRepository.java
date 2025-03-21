package com.suivi.flotte.repository;

import com.suivi.flotte.model.Chauffeur;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ChauffeurRepository extends JpaRepository<Chauffeur, Long> {
}
