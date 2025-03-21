package com.suivi.flotte.controller; // Modification du package

import com.suivi.flotte.model.Trajet; // Importation avec le bon package
import com.suivi.flotte.repository.TrajetRepository; // Importation avec le bon package
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/api/trajets")
public class TrajetController {

    @Autowired
    private TrajetRepository trajetRepository;

    // Récupérer tous les trajets
    @GetMapping
    public List<Trajet> getAllTrajets() {
        return trajetRepository.findAll();
    }

    // Récupérer un trajet par ID
    @GetMapping("/{id}")
    public ResponseEntity<Trajet> getTrajetById(@PathVariable Long id) {
        Optional<Trajet> trajet = trajetRepository.findById(id);
        if (trajet.isPresent()) {
            return ResponseEntity.ok(trajet.get());
        } else {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(null);
        }
    }

    // Ajouter un nouveau trajet
    @PostMapping
    public ResponseEntity<Trajet> createTrajet(@RequestBody Trajet trajet) {
        if (trajet != null) {
            Trajet savedTrajet = trajetRepository.save(trajet);
            return ResponseEntity.status(HttpStatus.CREATED).body(savedTrajet);
        }
        return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(null);
    }

    // Mettre à jour un trajet
    @PutMapping("/{id}")
    public ResponseEntity<Trajet> updateTrajet(@PathVariable Long id, @RequestBody Trajet trajet) {
        if (!trajetRepository.existsById(id)) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(null);
        }
        trajet.setId(id);  // On assure que l'ID est mis à jour dans la base
        Trajet updatedTrajet = trajetRepository.save(trajet);
        return ResponseEntity.ok(updatedTrajet);
    }

    // Supprimer un trajet
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteTrajet(@PathVariable Long id) {
        if (!trajetRepository.existsById(id)) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).build();
        }
        trajetRepository.deleteById(id);
        return ResponseEntity.status(HttpStatus.NO_CONTENT).build();
    }
}
