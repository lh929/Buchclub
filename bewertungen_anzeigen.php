<?php
// Verbindungsdaten zur Datenbank
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bewertungen_db";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung funktioniert
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// SQL-Abfrage, um alle Bewertungen abzurufen
$sql = "SELECT buchtitel, bewertung, kommentar, erstellt_am FROM bewertungen ORDER BY erstellt_am DESC";
$result = $conn->query($sql);

// HTML-Code für die Darstellung der Bewertungen
echo "<h1>Gespeicherte Buchbewertungen</h1>";
if ($result->num_rows > 0) {
    // Bewertungen anzeigen
    while ($row = $result->fetch_assoc()) {
        echo "<div class='bewertung'>";
        echo "<h3>" . $row["buchtitel"] . "</h3>";
        echo "<p>Bewertung: " . str_repeat("★", $row["bewertung"]) . str_repeat("☆", 5 - $row["bewertung"]) . "</p>";
        echo "<p>Kommentar: " . $row["kommentar"] . "</p>";
        echo "<small>Erstellt am: " . $row["erstellt_am"] . "</small>";
        echo "</div><hr>";
    }
} else {
    echo "Noch keine Bewertungen vorhanden.";
}

// Verbindung schließen
$conn->close();
?>
