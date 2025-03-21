package com.suivi.flotte;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class HomeController {

    @GetMapping("/")
    public String home() {
        return "index"; // Ce sera un fichier Thymeleaf (index.html)
    }
}
