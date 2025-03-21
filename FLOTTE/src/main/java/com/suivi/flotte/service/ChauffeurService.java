package com.suivi.flotte.service;

import com.suivi.flotte.model.Chauffeur;
import com.suivi.flotte.repository.ChauffeurRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class ChauffeurService {

    @Autowired
    private ChauffeurRepository chauffeurRepository;

    public List<Chauffeur> getAllChauffeurs() {
        return chauffeurRepository.findAll();
    }

    public Optional<Chauffeur> getChauffeurById(Long id) {
        return chauffeurRepository.findById(id);
    }

    public Chauffeur addChauffeur(Chauffeur chauffeur) {
        // L'ID est généré automatiquement lors de l'enregistrement
        return chauffeurRepository.save(chauffeur);
    }

    public Chauffeur updateChauffeur(Long id, Chauffeur chauffeurDetails) {
        Chauffeur chauffeur = chauffeurRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Chauffeur not found"));

        // Mettre à jour les champs
        chauffeur.setNom(chauffeurDetails.getNom());
        chauffeur.setPrenoms(chauffeurDetails.getPrenoms());
        chauffeur.setEmail(chauffeurDetails.getEmail());
        chauffeur.setContact(chauffeurDetails.getContact());
        chauffeur.setAdresse(chauffeurDetails.getAdresse());

        return chauffeurRepository.save(chauffeur);
    }

    public void deleteChauffeur(Long id) {
        Chauffeur chauffeur = chauffeurRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Chauffeur not found"));
        chauffeurRepository.delete(chauffeur);
    }
}
