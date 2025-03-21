package com.suivi.flotte.service;

import com.suivi.flotte.model.Vehicule;
import com.suivi.flotte.repository.VehiculeRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import javax.persistence.EntityNotFoundException;
import java.util.List;
import java.util.Optional;

@Service
public class VehiculeService {

    @Autowired
    private VehiculeRepository vehiculeRepository;

    // Récupérer tous les véhicules
    public List<Vehicule> getAllVehicules() {
        return vehiculeRepository.findAll();
    }

    // Récupérer un véhicule par ID
    public Optional<Vehicule> getVehiculeById(Long id) {
        return vehiculeRepository.findById(id);
    }

    // Ajouter un véhicule
    public Vehicule addVehicule(Vehicule vehicule) {
        return vehiculeRepository.save(vehicule);
    }

    // Mettre à jour un véhicule
    public Vehicule updateVehicule(Long id, Vehicule vehicule) {
        // Récupérer le véhicule existant de la base de données
        Optional<Vehicule> existingVehicule = vehiculeRepository.findById(id);

        if (existingVehicule.isPresent()) {
            Vehicule updatedVehicule = existingVehicule.get();
            updatedVehicule.setImmatriculation(vehicule.getImmatriculation());
            updatedVehicule.setModel(vehicule.getModel());
            updatedVehicule.setCouleur(vehicule.getCouleur());
            updatedVehicule.setNbrePassager(vehicule.getNbrePassager());
            return vehiculeRepository.save(updatedVehicule);  // Sauvegarder le véhicule mis à jour
        } else {
            throw new EntityNotFoundException("Véhicule non trouvé avec l'ID " + id);
        }
    }

    // Supprimer un véhicule
    public void deleteVehicule(Long id) {
        Optional<Vehicule> existingVehicule = vehiculeRepository.findById(id);
        if (existingVehicule.isPresent()) {
            vehiculeRepository.deleteById(id);
        } else {
            throw new EntityNotFoundException("Véhicule non trouvé avec l'ID " + id);
        }
    }
}
