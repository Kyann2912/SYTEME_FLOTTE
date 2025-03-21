package com.suivi.flotte.controller;

import com.suivi.flotte.model.VehicleTracking;
import com.suivi.flotte.service.VehicleTrackingService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/api/v1/trackings")
public class VehicleTrackingController {

    @Autowired
    private VehicleTrackingService vehicleTrackingService;

    // Ajouter un suivi
    @PostMapping
    public VehicleTracking addTracking(@RequestBody VehicleTracking vehicleTracking) {
        return vehicleTrackingService.addTracking(vehicleTracking);
    }

    // Modifier un suivi
    @PutMapping("/{id}")
    public ResponseEntity<VehicleTracking> updateTracking(@PathVariable Long id, @RequestBody VehicleTracking vehicleTracking) {
        VehicleTracking updatedTracking = vehicleTrackingService.updateTracking(id, vehicleTracking);
        if (updatedTracking == null) {
            return ResponseEntity.notFound().build(); // Retourne 404 si le suivi n'a pas été trouvé
        }
        return ResponseEntity.ok(updatedTracking); // Retourne 200 OK avec le suivi modifié
    }

    // Supprimer un suivi
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteTracking(@PathVariable Long id) {
        boolean isDeleted = vehicleTrackingService.deleteTracking(id);
        if (!isDeleted) {
            return ResponseEntity.notFound().build(); // Retourne 404 si le suivi n'a pas été trouvé
        }
        return ResponseEntity.noContent().build(); // Retourne 204 No Content si la suppression a réussi
    }

    // Afficher la liste des suivis
    @GetMapping
    public List<VehicleTracking> getAllTrackings() {
        return vehicleTrackingService.getAllTrackings();
    }

    // Obtenir un suivi par ID
    @GetMapping("/{id}")
    public ResponseEntity<VehicleTracking> getTrackingById(@PathVariable Long id) {
        Optional<VehicleTracking> tracking = vehicleTrackingService.getTrackingById(id);
        if (tracking.isEmpty()) {
            return ResponseEntity.notFound().build(); // Retourne 404 si le suivi n'a pas été trouvé
        }
        return ResponseEntity.ok(tracking.get()); // Retourne 200 OK avec les détails du suivi
    }
}
