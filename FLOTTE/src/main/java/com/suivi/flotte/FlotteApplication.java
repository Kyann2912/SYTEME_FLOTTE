package com.suivi.flotte;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.jpa.repository.config.EnableJpaRepositories;

@SpringBootApplication
@EnableJpaRepositories("com.suivi.flotte.repository")  // Assurez-vous que le package de vos repositories est bien scanné
public class FlotteApplication {

	public static void main(String[] args) {
		SpringApplication.run(FlotteApplication.class, args);
	}
}
