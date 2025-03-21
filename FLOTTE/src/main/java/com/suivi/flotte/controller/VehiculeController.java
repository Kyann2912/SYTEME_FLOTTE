package com.suivi.flotte.controller;

import com.suivi.flotte.model.Vehicule;
import com.suivi.flotte.service.VehiculeService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/api/vehicules")
public class VehiculeController {

    @Autowired
    private VehiculeService vehiculeService;

    // Récupérer la liste des véhicules
    @GetMapping
    public List<Vehicule> getAllVehicules() {
        return vehiculeService.getAllVehicules();
    }

    // Récupérer un véhicule par ID
    @GetMapping("/{id}")
    public Optional<Vehicule> getVehiculeById(@PathVariable Long id) {
        return vehiculeService.getVehiculeById(id);
    }

    // Ajouter un véhicule
    @PostMapping
    public Vehicule addVehicule(@RequestBody @Valid Vehicule vehicule) {
        return vehiculeService.addVehicule(vehicule);
    }

    // Mettre à jour un véhicule
    @PutMapping("/{id}")
    public Vehicule updateVehicule(@PathVariable Long id, @RequestBody @Valid Vehicule vehicule) {
        // Passer l'ID au service sans tenter de modifier l'ID dans l'objet vehicule
        return vehiculeService.updateVehicule(id, vehicule);
    }

    // Supprimer un véhicule
    @DeleteMapping("/{id}")
    public void deleteVehicule(@PathVariable Long id) {
        vehiculeService.deleteVehicule(id);
    }
}
