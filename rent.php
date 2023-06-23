<!DOCTYPE html>
<html>
<head>
    <title>Wypożyczanie samochodu</title>
</head>
<body>

<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
    // Jeśli użytkownik nie jest zalogowany, przekieruj go do strony logowania
    header("Location: login.php");
    exit();
}


// Połącz z bazą danych
try {
    $db = new PDO('sqlite:inzynieria.db');
} catch (PDOException $e) {
    echo "Błąd połączenia z bazą danych: " . $e->getMessage();
    exit();
}

// Sprawdź czy użytkownik jest zalogowany
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

    // Pobierz ID samochodu
    $car_id = $_GET['car_id'];

    // Pobierz dane samochodu z bazy danych
    $query = "SELECT * FROM cars WHERE car_id = :car_id";
    $stmt = $db->prepare($query);
    $stmt->execute(['car_id' => $car_id]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($car) {
        // Wyświetl dane samochodu
        echo "<h2>{$car['make']} {$car['model']}</h2>";
        echo "<img src='{$car['image']}' alt='{$car['make']} {$car['model']}'>";

        // Wyświetl formularz rezerwacji
        echo '<form action="process_rental.php" method="post">';
        echo '    <input type="hidden" name="car_id" value="' . $car_id . '">';
        echo '    Imię i nazwisko: <input type="text" name="full_name"><br>';
        echo '    Data początku: <input type="date" name="start_date"><br>';
        echo '    Data końca: <input type="date" name="end_date"><br>';
        echo '    <input type="submit" value="Wypożycz">';
        echo '</form>';
    } else {
        echo "Nie znaleziono samochodu.";
    }

} else {
    echo "Musisz być zalogowany, aby wypożyczyć samochód.";
}
?>

</body>
</html>
