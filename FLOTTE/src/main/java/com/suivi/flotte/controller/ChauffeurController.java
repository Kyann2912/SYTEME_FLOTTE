package com.suivi.flotte.controller;

import com.suivi.flotte.model.Chauffeur;
import com.suivi.flotte.service.ChauffeurService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;  // Ajout de l'importation manquante pour List

@RestController
@RequestMapping("/api/chauffeurs")
public class ChauffeurController {

    @Autowired
    private ChauffeurService chauffeurService;

    // Ajouter un chauffeur
    @PostMapping
    public ResponseEntity<Chauffeur> addChauffeur(@RequestBody Chauffeur chauffeur) {
        Chauffeur newChauffeur = chauffeurService.addChauffeur(chauffeur);
        return ResponseEntity.ok(newChauffeur);
    }

    // Mettre à jour un chauffeur
    @PutMapping("/{id}")
    public ResponseEntity<Chauffeur> updateChauffeur(@PathVariable Long id, @RequestBody Chauffeur chauffeur) {
        Chauffeur updatedChauffeur = chauffeurService.updateChauffeur(id, chauffeur);
        return ResponseEntity.ok(updatedChauffeur);
    }

    // Supprimer un chauffeur
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteChauffeur(@PathVariable Long id) {
        chauffeurService.deleteChauffeur(id);
        return ResponseEntity.noContent().build();
    }

    // Obtenir tous les chauffeurs
    @GetMapping
    public ResponseEntity<List<Chauffeur>> getAllChauffeurs() {
        return ResponseEntity.ok(chauffeurService.getAllChauffeurs());
    }

    // Obtenir un chauffeur par ID
    @GetMapping("/{id}")
    public ResponseEntity<Chauffeur> getChauffeurById(@PathVariable Long id) {
        return chauffeurService.getChauffeurById(id)
                .map(ResponseEntity::ok)
                .orElseGet(() -> ResponseEntity.notFound().build());
    }
}
