<?php
// Ścieżka do pliku bazy danych SQLite
$databasePath = 'inzynieria.db';

try {
    // Tworzenie połączenia PDO z bazą danych
    $pdo = new PDO("sqlite:$databasePath");

    // Ustawienie opcji dla PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Wykonanie zapytania
    $query = "SELECT * FROM cars";
    $stmt = $pdo->query($query);

    // Przetwarzanie wyników
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Przykład wypisania danych
        echo "ID: " . $row['car_id'] . ", Nazwa: " . $row['model'] . "<br>";
    }

    // Zamknięcie połączenia
    $pdo = null;
} catch (PDOException $e) {
    // Obsługa błędów
    echo "Błąd połączenia z bazą danych: " . $e->getMessage();
}
?>
