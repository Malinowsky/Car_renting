<?php
session_start();

// Połącz z bazą danych
try {
    $db = new PDO('sqlite:inzynieria.db');
} catch (PDOException $e) {
    echo "Błąd połączenia z bazą danych: " . $e->getMessage();
    exit();
}

// Pobierz dane z formularza
$car_id = $_POST['car_id'];
$full_name = $_POST['full_name'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// Pobierz user_id z sesji, jeśli użytkownik jest zalogowany
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Sprawdź, czy daty są prawidłowe
$current_date = date("Y-m-d");
if ($start_date < $current_date || $end_date < $current_date) {
    echo "Nie można wybrać daty z przeszłości.";
    exit();
}

if ($end_date < $start_date) {
    echo "Data zakończenia nie może być wcześniejsza niż data początkowa.";
    exit();
}

// Oblicz liczbę dni
$datetime1 = new DateTime($start_date);
$datetime2 = new DateTime($end_date);
$interval = $datetime1->diff($datetime2);
$number_of_days = $interval->format('%a');

// Pobierz stawkę dzienną z tabeli cars
$query = "SELECT daily_rate FROM cars WHERE car_id = :car_id";
$stmt = $db->prepare($query);
$stmt->execute(['car_id' => $car_id]);
$daily_rate = $stmt->fetchColumn();

// Oblicz całkowity koszt
$total_cost = $number_of_days * $daily_rate;

// Sprawdź, czy samochód jest dostępny
$query = "SELECT * FROM rentals WHERE car_id = :car_id AND ((start_date BETWEEN :start_date AND :end_date) OR (end_date BETWEEN :start_date AND :end_date))";
$stmt = $db->prepare($query);
$stmt->execute(['car_id' => $car_id, 'start_date' => $start_date, 'end_date' => $end_date]);

if ($stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "Samochód jest już zarezerwowany w wybranym terminie.";
} else {
    // Dodaj rezerwację do bazy danych
    $query = "INSERT INTO rentals (user_id, car_id, start_date, end_date, total_cost) VALUES (:user_id, :car_id, :start_date, :end_date, :total_cost)";
    $stmt = $db->prepare($query);
    $stmt->execute(['user_id' => $user_id, 'car_id' => $car_id, 'start_date' => $start_date, 'end_date' => $end_date, 'total_cost' => $total_cost]);

    echo "Samochód został pomyślnie zarezerwowany.";
}
?>
