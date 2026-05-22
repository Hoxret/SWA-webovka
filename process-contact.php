<?php
/**
 * NBA PLAYOFFS 2026 - Zpracování kontaktního formuláře
 * Tento skript přijímá data z kontakt.html a (simulovaně) je odesílá na e-mail.
 */

// Kontrola, zda byla data odeslána metodou POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Načtení a vyčištění vstupních dat
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject_key = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));

    // Mapování předmětů na čitelný text
    $subjects = [
        "tickets" => "VSTUPENKY A POHOSTINSTVÍ",
        "media"   => "MÉDIA A VZTAHY S VEŘEJNOSTÍ",
        "general" => "OBECNÉ INFORMACE"
    ];
    $subject_text = isset($subjects[$subject_key]) ? $subjects[$subject_key] : "Neznámý předmět";

    // Validace dat
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // V případě chyby přesměruj zpět s chybovým hlášením (v reálné aplikaci)
        header("Location: kontakt.html?status=error");
        exit;
    }

    // Nastavení e-mailu (Změňte na svůj reálný e-mail)
    $recipient = "czplayoffs@nba.com";
    $email_subject = "Nový dotaz z webu: $subject_text";
    
    // Sestavení obsahu e-mailu
    $email_content = "Jméno: $name\n";
    $email_content .= "E-mail: $email\n\n";
    $email_content .= "Předmět: $subject_text\n";
    $email_content .= "Zpráva:\n$message\n";

    // E-mailové hlavičky
    $email_headers = "From: $name <$email>";

    // Odeslání e-mailu (Funkce mail() vyžaduje nastavený server)
    // if (mail($recipient, $email_subject, $email_content, $email_headers)) {
    //     header("Location: potvrzeni.html");
    // } else {
    //     header("Location: kontakt.html?status=error");

    // }

    // Pro účely ukázky pouze přesměrujeme s úspěchem
    header("Location: potvrzeni.html");
    exit;


} else {
    // Pokud někdo přistoupí přímo ke skriptu bez odeslání formuláře
    header("Location: kontakt.html");
    exit;
}
?>
