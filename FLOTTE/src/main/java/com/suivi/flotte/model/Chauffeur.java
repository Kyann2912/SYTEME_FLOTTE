package com.suivi.flotte.model;

import javax.persistence.*;
import java.util.Date;

@Entity
public class Chauffeur {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)  // L'ID est généré automatiquement
    private Long id;

    private String nom;
    private String prenoms;
    private String email;
    private String contact;
    private String adresse;

    @Temporal(TemporalType.DATE)
    private Date dateNaissance;

    // Constructeurs
    public Chauffeur() {}

    public Chauffeur(String nom, String prenoms, String email, String contact, String adresse, Date dateNaissance) {
        this.nom = nom;
        this.prenoms = prenoms;
        this.email = email;
        this.contact = contact;
        this.adresse = adresse;
        this.dateNaissance = dateNaissance;
    }

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

    public String getPrenoms() {
        return prenoms;
    }

    public void setPrenoms(String prenoms) {
        this.prenoms = prenoms;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getContact() {
        return contact;
    }

    public void setContact(String contact) {
        this.contact = contact;
    }

    public String getAdresse() {
        return adresse;
    }

    public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

    public Date getDateNaissance() {
        return dateNaissance;
    }

    public void setDateNaissance(Date dateNaissance) {
        this.dateNaissance = dateNaissance;
    }
}
