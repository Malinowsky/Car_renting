<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wypożyczalnia aut sportowych</title>

    <!-- styles -->
    <!-- fontaswome -->
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">

    <!-- phone styles -->
    <link rel="stylesheet" href="css/main.css">

    <!-- tablet styles -->
    <link rel="stylesheet" href="css/main-tablet.css">

    <!-- PC styles -->
    <link rel="stylesheet" href="css/main-pc.css">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/ico" href="img/favicon.ico">
</head>

<body>
    <div class="wrapper">
        <!-- Mobile/Tablet version header -->
        <nav class="navbar">
            <button onclick="toggleNavbar()"><i class="fa-solid fa-xmark"></i></button>
            <ul>
                <li><a href="index.html">strona główna</a></li>
                <li><a href="cars.php">samochody</a></li>
                <li><a href="about.html">dlaczego my?</a></li>
                <li><a href="voucher.php">vouchery</a></li>
                <li><a href="howworks.html">jak to działa?</a></li>
                <a href="cars.php">zarezerwuj</a>
                <div class="phone_number_box">
                    <p>Skontaktuj sie z nami</p>
                    <a href="tel:000-000-000"><i class="fa-solid fa-phone"></i>+48 000 000 000</a>
                    <a href="mailto: szybka@jazda.pl"><i class="fa-solid fa-paper-plane"></i>szybka@jazda.pl</a>
                </div>
            </ul>
        </nav>

        <header class="header clearfix">
            <button onclick="toggleNavbar()"><i class="fa-solid fa-bars"></i></button>
            <div class="nav_contacts">
                <button onclick="toggleContact()"><i class="fa-solid fa-phone-volume"></i></button>
                <button><a class="link_button" href="login.php"><i class="fa-solid fa-right-to-bracket"></i></a></button>
                <div class="phone_number_boxDisplay">
                    <div class="phone_number_box">
                        <p>Skontaktuj sie z nami</p>
                        <a href="tel:000-000-000"><i class="fa-solid fa-phone"></i>+48 000 000 000</a>
                        <a href="mailto: szybka@jazda.pl"><i class="fa-solid fa-paper-plane"></i>szybka@jazda.pl</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- -------------------------------------------- -->

        <!-- PC version header -->
        <header class="header_pc clearfix">
            <div class="nav_menu">
                <ul>
                    <li><a href="index.html">strona główna</a></li>
                    <li><a href="cars.php">samochody</a></li>
                    <li><a href="about.html">dlaczego my?</a></li>
                    <li><a href="voucher.php">vouchery</a></li>
                    <li><a href="howworks.html">jak to działa?</a></li>
                </ul>
            </div>
            <button><a class="link_button" href="login.php"><i class="fa-solid fa-right-to-bracket"></i></a></button>
        </header>
        <!-- --------------------------------------- -->

        <main>
            <div class="main_wrap">
                <h1 class="company_name">szybka jazda</h1>
                <img class="img_logo" src="img/logo.png" alt="engine with star - logo">
                <div class="main_buttons">
                    <a href="cars.php"><button class="blue_button">lista samochodów</button></a>
                </div>
            </div>
        </main>

        <section class="contact">
            <div class="phone_email">
                <div class="nav_contacts">
                    <h1 class="company_name">szybka jazda</h1>
                    <a href="tel:000-000-000"><i class="fa-solid fa-phone"></i>+48 000 000 000</a>
                    <a href="mailto: szybka@jazda.pl"><i class="fa-solid fa-paper-plane"></i>szybka@jazda.pl</a>
                </div>
            </div>
            <div class="contact_form">
                <h2>napisz do nas</h2>
                <form action="#">
                    <label for="user-email">Twoj adres e-mail:</label>
                    <input id="user-email" type="email">
                    <label for="user-message">Treść wiadomości:</label>
                    <input id="user-email" type="textarea">
                    <div class="checkbox_div">
                        <input type="checkbox" name="personal-data" id="personal-data" required><p>Zgadzam się na wykorzystanie danych osobowych zgodnie z Polityką Prywatności</p>
                    </div>
                    <input type="submit" value="WYŚLIJ WIADOMOŚĆ">
                </form>
            </div>
        </section>

        <footer>
            <p><span>szybka jazda</span> &copy; 2023 Copyright Szybka Jazda</p>
        </footer>
    </div>

    <script src="js/toggle.js"></script>
</body>

</html>

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
    echo '<script>alert("Nie można wybrać daty z przeszłości.");</script>';

    exit();
}

if ($end_date < $start_date) {
    echo '<script>alert("Data zakończenia nie może być wcześniejsza niż data początkowa.");</script>';
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
    echo '<script>alert("Samochód jest już zarezerwowany w wybranym terminie.");</script>';


} else {
    // Dodaj rezerwację do bazy danych
    $query = "INSERT INTO rentals (user_id, car_id, start_date, end_date, total_cost) VALUES (:user_id, :car_id, :start_date, :end_date, :total_cost)";
    $stmt = $db->prepare($query);
    $stmt->execute(['user_id' => $user_id, 'car_id' => $car_id, 'start_date' => $start_date, 'end_date' => $end_date, 'total_cost' => $total_cost]);
    echo '<script>alert("Samochód został pomyślnie zarezerwowany.");</script>';
}
?>
