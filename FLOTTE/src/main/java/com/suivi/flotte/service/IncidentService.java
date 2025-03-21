package com.suivi.flotte.service;

import com.suivi.flotte.model.Incident;
import com.suivi.flotte.repository.IncidentRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class IncidentService {

    @Autowired
    private IncidentRepository incidentRepository;

    // Récupérer tous les incidents
    public List<Incident> getAllIncidents() {
        return incidentRepository.findAll();
    }

    // Récupérer un incident par ID
    public Optional<Incident> getIncidentById(Long id) {
        return incidentRepository.findById(id);
    }

    // Ajouter un incident
    public Incident addIncident(Incident incident) {
        return incidentRepository.save(incident);
    }

    // Mettre à jour un incident
    public Incident updateIncident(Long id, Incident incident) {
        Optional<Incident> existingIncident = incidentRepository.findById(id);

        if (existingIncident.isPresent()) {
            Incident updatedIncident = existingIncident.get();
            updatedIncident.setType(incident.getType());
            updatedIncident.setDescription(incident.getDescription());
            return incidentRepository.save(updatedIncident);
        } else {
            return null; // Ou lever une exception si nécessaire
        }
    }

    // Supprimer un incident
    public void deleteIncident(Long id) {
        incidentRepository.deleteById(id);
    }
}
