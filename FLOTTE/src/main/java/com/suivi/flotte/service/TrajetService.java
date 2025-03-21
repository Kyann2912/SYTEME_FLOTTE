package com.suivi.flotte.service;

import com.suivi.flotte.model.Trajet;
import com.suivi.flotte.repository.TrajetRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class TrajetService {

    @Autowired
    private TrajetRepository trajetRepository;

    // Ajouter un trajet
    public Trajet ajouterTrajet(Trajet trajet) {
        return trajetRepository.save(trajet);
    }

    // Modifier un trajet existant
    public Trajet modifierTrajet(Long id, Trajet trajet) {
        Optional<Trajet> trajetExist = trajetRepository.findById(id);
        if (trajetExist.isPresent()) {
            Trajet trajetToUpdate = trajetExist.get();
            trajetToUpdate.setNom(trajet.getNom());
            trajetToUpdate.setDistance(trajet.getDistance());
            trajetToUpdate.setDate(trajet.getDate());
            return trajetRepository.save(trajetToUpdate);
        } else {
            throw new RuntimeException("Trajet non trouvé");
        }
    }

    // Supprimer un trajet
    public void supprimerTrajet(Long id) {
        trajetRepository.deleteById(id);
    }

    // Obtenir la liste de tous les trajets
    public List<Trajet> listerTousLesTrajets() {
        return trajetRepository.findAll();
    }

    // Obtenir un trajet par ID
    public Optional<Trajet> obtenirTrajetParId(Long id) {
        return trajetRepository.findById(id);
    }
}
