package com.suivi.flotte.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import com.suivi.flotte.model.VehicleTracking;
import com.suivi.flotte.repository.VehicleTrackingRepository;

import java.util.List;
import java.util.Optional;

@Service
public class VehicleTrackingService {

    @Autowired
    private VehicleTrackingRepository vehicleTrackingRepository;

    // Ajouter un suivi
    public VehicleTracking addTracking(VehicleTracking vehicleTracking) {
        return vehicleTrackingRepository.save(vehicleTracking);
    }

    // Modifier un suivi existant
    public VehicleTracking updateTracking(Long id, VehicleTracking vehicleTracking) {
        Optional<VehicleTracking> existingTracking = vehicleTrackingRepository.findById(id);
        if (existingTracking.isPresent()) {
            VehicleTracking existing = existingTracking.get();
            existing.setImmatriculation(vehicleTracking.getImmatriculation());  // Mettre à jour l'immatriculation
            existing.setLongitude(vehicleTracking.getLongitude());              // Mettre à jour la longitude
            existing.setAltitude(vehicleTracking.getAltitude());                // Mettre à jour l'altitude
            existing.setTrajet(vehicleTracking.getTrajet());                    // Mettre à jour le trajet
            return vehicleTrackingRepository.save(existing);                    // Sauvegarder les modifications
        }
        return null; // Retourner null si le suivi n'existe pas
    }

    // Supprimer un suivi
    public boolean deleteTracking(Long id) {
        if (vehicleTrackingRepository.existsById(id)) {
            vehicleTrackingRepository.deleteById(id);
            return true; // Retourne true si le suivi a été supprimé
        }
        return false; // Retourne false si le suivi n'existe pas
    }

    // Obtenir tous les suivis
    public List<VehicleTracking> getAllTrackings() {
        return vehicleTrackingRepository.findAll();
    }

    // Obtenir un suivi par ID
    public Optional<VehicleTracking> getTrackingById(Long id) {
        return vehicleTrackingRepository.findById(id); // Retourne Optional pour gérer le cas où l'élément n'existe pas
    }
}
