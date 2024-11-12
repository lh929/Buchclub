<?php
// Verbindungsdaten zur Datenbank
$servername = "localhost";
$username = "root"; // MySQL-Benutzername
$password = ""; // MySQL-Passwort
$dbname = "bewertungen_db";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung funktioniert
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formularwerte auslesen
    $buchtitel = $conn->real_escape_string($_POST["buchtitel"]);
    $bewertung = (int) $_POST["bewertung"];
    $kommentar = $conn->real_escape_string($_POST["kommentar"]);

    // SQL-Abfrage zum Einfügen der Bewertung in die Datenbank
    $sql = "INSERT INTO bewertungen (buchtitel, bewertung, kommentar)
            VALUES ('$buchtitel', '$bewertung', '$kommentar')";

    if ($conn->query($sql) === TRUE) {
        echo "Bewertung erfolgreich gespeichert!";
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
}

// Verbindung schließen
$conn->close();
?>
