<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once('tcpdf/tcpdf.php');

if (isset($_POST['submit'])) {

    if (filter_var($_POST['contactEmail'], FILTER_VALIDATE_EMAIL)) {

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $formData = $_POST;
        $pdf->SetMargins(20, 20, 20);
        $pdf->AddPage();
        $pdf->SetFont('Helvetica', '', 12);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);

        $html = <<<HTML
            <img src="img/legacy-logo.jpg" style="width: 90px; height: auto;">
            <h1>Legacy Dance Competition 2024</h1>
            <p><strong>Naam dansstudio / vereniging:</strong> {$_POST['naamVereniging']}</p>
            <p><strong>Plaats dansstudio / vereniging:</strong> {$_POST['plaatsVereniging']}</p>
            <h3 style="color:#FFB40C"><strong>Factuurgegevens</strong></h3>
            <p><strong>Contactpersoon:</strong> {$_POST['voornaam']} {$_POST['achternaam']}</p>
            <p><strong>Telefoonnummer:</strong> {$_POST['contactTel']}</p>
            <p><strong>Email:</strong> {$_POST['contactEmail']}</p>
            <p><strong>Adres:</strong> {$_POST['straatnaam']} {$_POST['huisnummer']}, {$_POST['postcode']} {$_POST['woonplaats']}</p>
          HTML;

        if (!empty($_POST['naam'])) {
            $html .= <<<HTML
                <h3 style="color:#FFB40C">Coach(es)</h3>
                <p><strong>Naam:</strong> {$_POST['naam']} </p>
                <p><strong>Telefoonnummer:</strong> {$_POST['telefoon']}</p>
                <p><strong>Email:</strong> {$_POST['email']}</p>
            HTML;

            $countCoach = 0;

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'naam') !== false) {
                    $countCoach++;
                }
            }

            for ($i = 1; $i <= $countCoach; $i++) {
                if (isset($_POST['naam' . $i])) {
                    $html .= <<<HTML
                    <p><strong>Naam:</strong> {$_POST['naam' .$i]} </p>
                    <p><strong>Telefoonnummer:</strong> {$_POST['telefoon' .$i]}</p>
                    <p><strong>Email:</strong> {$_POST['email' .$i]}</p>
                HTML;
                }
            }
        }

        if (!empty($_POST['teamnaam'])) {
            $html .= <<<HTML
        <h3 style="color:#FFB40C">Team(s)</h3>
        <p><strong>Teamnaam:</strong> {$_POST['teamnaam']} </p>
        <p><strong>Categorie:</strong> {$_POST['categorieTeam']}</p>
        <p><strong>Aantal dansers:</strong> {$_POST['aantalDansers']}</p>
        HTML;

            $countTeam = 0;

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'teamnaam') !== false) {
                    $countTeam++;
                }
            }

            for ($i = 1; $i <= $countTeam; $i++) {
                if (isset($_POST['teamnaam' . $i])) {
                    $html .= <<<HTML
                    <p><strong>Teamnaam:</strong> {$_POST['teamnaam' .$i]} </p>
                    <p><strong>Categorie:</strong> {$_POST['categorieTeam' .$i]}</p>
                    <p><strong>Aantal dansers:</strong> {$_POST['aantalDansers' .$i]}</p>
                HTML;
                }
            }
        }

        if (!empty($_POST['namenDansers'])) {
            $html .= <<<HTML
        <h3 style="color:#FFB40C">Duo(s)</h3>
        <p><strong>Namen dansers:</strong> {$_POST['namenDansers']} </p>
        <p><strong>Categorie:</strong> {$_POST['categorieDuo']}</p>
        HTML;

            $countDuo = 0;

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'namenDansers') !== false) {
                    $countDuo++;
                }
            }

            for ($i = 1; $i <= $countDuo; $i++) {
                if (isset($_POST['namenDansers' . $i])) {
                    $html .= <<<HTML
                    <p><strong>Namen dansers:</strong> {$_POST['namenDansers' .$i]} </p>
                    <p><strong>Categorie:</strong> {$_POST['categorieDuo' .$i]}</p>
                HTML;
                }
            }
        }

        if (!empty($_POST['opmerkingen'])) {
            $html .= <<<HTML
        <h3 style="color:#FFB40C">Opmerkingen</h3> <p>{$_POST['opmerkingen']}</p>
        HTML;
        }

        $pdf->writeHTML($html);
        $pdfOutput = $pdf->Output('', 'S');

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('');
            $mail->addAddress($_POST['contactEmail'], $_POST['voornaam'] . ' ' . $_POST['achternaam']);

            $mail->isHTML(true);
            $mail->Subject = 'Bevestiging inschrijving LDC';

            $mail->Body = "<p>Bedankt voor je inschrijving aan LDC 2024!</p>
            <p>Mochten er tussentijds nog vragen zijn of wijzigingen, laat het ons dan weten. Houdt verder onze Instagram en Facebook pagina in de gaten voor verdere ontwikkelingen wat betreft LDC 2024. In de mailing staat ook het wedstrijdreglement vermeld, lees dit goed door.</p>
            <p>Heel veel succes met de voorbereidingen en tot zaterdag 29 juni!</p>
            <p>Met vriendelijke groet,<p>
            Zacharias Douma<br>
            Dansschool The Legacy<br>
            06-17291742<br>
            info@dansschoolthelegacy.nl</p>";

            $mail->addStringAttachment($pdfOutput, 'inschrijving.pdf');

            $mail->send();

            echo 'Yes, je bent succesvol ingeschreven! Binnen enkele minuten ontvang je een bevestiging per mail.';
        } catch (Exception $e) {
            echo 'Er is een probleem opgetreden bij het verzenden van de e-mail: ', $mail->ErrorInfo;
        }
    } else {
        echo 'Eén of beide opgegeven e-mailadressen zijn ongeldig.';
    }
}
