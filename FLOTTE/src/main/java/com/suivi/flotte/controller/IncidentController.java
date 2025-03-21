package com.suivi.flotte.controller;

import com.suivi.flotte.model.Incident;
import com.suivi.flotte.service.IncidentService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/api/incidents")
public class IncidentController {

    @Autowired
    private IncidentService incidentService;

    // Récupérer tous les incidents
    @GetMapping
    public List<Incident> getAllIncidents() {
        return incidentService.getAllIncidents();
    }

    // Récupérer un incident par ID
    @GetMapping("/{id}")
    public Optional<Incident> getIncidentById(@PathVariable Long id) {
        return incidentService.getIncidentById(id);
    }

    // Ajouter un incident
    @PostMapping
    public Incident addIncident(@RequestBody @Valid Incident incident) {
        return incidentService.addIncident(incident);
    }

    // Mettre à jour un incident
    @PutMapping("/{id}")
    public Incident updateIncident(@PathVariable Long id, @RequestBody @Valid Incident incident) {
        return incidentService.updateIncident(id, incident);
    }

    // Supprimer un incident
    @DeleteMapping("/{id}")
    public void deleteIncident(@PathVariable Long id) {
        incidentService.deleteIncident(id);
    }
}
