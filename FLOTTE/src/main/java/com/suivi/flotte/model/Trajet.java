package com.suivi.flotte.model;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import java.time.LocalDate;

@Entity
public class Trajet {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String nom;
    private Double distance;
    private Long idchauffeur;
    private Long idvehicule;

    // Ajout du champ date
    private LocalDate date; // Ajout d'un champ de type LocalDate pour la date

    // Getters et setters

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public Double getDistance() {
        return distance;
    }

    public void setDistance(Double distance) {
        this.distance = distance;
    }

    public Long getIdchauffeur() {
        return idchauffeur;
    }

    public void setIdchauffeur(Long idchauffeur) {
        this.idchauffeur = idchauffeur;
    }

    public Long getIdvehicule() {
        return idvehicule;
    }

    public void setIdvehicule(Long idvehicule) {
        this.idvehicule = idvehicule;
    }

    // Getter et setter pour la date
    public LocalDate getDate() {
        return date;
    }

    public void setDate(LocalDate date) {
        this.date = date;
    }
}
