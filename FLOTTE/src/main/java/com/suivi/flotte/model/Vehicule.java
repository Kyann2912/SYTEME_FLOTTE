package com.suivi.flotte.model;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Column;

@Entity
public class Vehicule {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)  // Utilisation de l'auto-incrémentation de l'ID
    @Column(nullable = false)
    private Long id;

    @Column(nullable = false, length = 50)
    private String immatriculation;

    @Column(nullable = false, length = 50)
    private String model;

    @Column(nullable = false, length = 30)
    private String couleur;

    @Column(name = "nbre_passager", nullable = false)
    private Integer nbrePassager;

    // Getters et setters
    public Long getId() {
        return id;
    }

    public String getImmatriculation() {
        return immatriculation;
    }

    public void setImmatriculation(String immatriculation) {
        this.immatriculation = immatriculation;
    }

    public String getModel() {
        return model;
    }

    public void setModel(String model) {
        this.model = model;
    }

    public String getCouleur() {
        return couleur;
    }

    public void setCouleur(String couleur) {
        this.couleur = couleur;
    }

    public Integer getNbrePassager() {
        return nbrePassager;
    }

    public void setNbrePassager(Integer nbrePassager) {
        this.nbrePassager = nbrePassager;
    }
}
