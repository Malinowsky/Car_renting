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
    <link rel="stylesheet" href="css/login.css">
    
    <!-- tablet styles -->
    <link rel="stylesheet" href="css/main-tablet.css">
    <link rel="stylesheet" href="css/login-tablet.css">
    
    <!-- favicon -->
    <link rel="shortcut icon" type="image/ico" href="img/favicon.ico">
</head>

<body>
    <div class="wrapper">
        <nav class="navbar">
            <button onclick="toggleNavbar()"><i class="fa-solid fa-xmark"></i></button>
            <ul>
                <li><a href="index.html">strona główna</a></li>
                <li><a href="cars.php">samochody</a></li>
                <li><a href="about.html">dlaczego my?</a></li>
                <li><a href="voucher.html">vouchery</a></li>
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
                <button><a class="link_button" href="index.html"><i class="fa-solid fa-house"></i></a></button>
                <div class="phone_number_boxDisplay">
                    <div class="phone_number_box">
                        <p>Skontaktuj sie z nami</p>
                        <a href="tel:000-000-000"><i class="fa-solid fa-phone"></i>+48 000 000 000</a>
                        <a href="mailto: szybka@jazda.pl"><i class="fa-solid fa-paper-plane"></i>szybka@jazda.pl</a>
                    </div>
                </div>
            </div>
        </header>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Pobierz dane z formularza
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Połącz z bazą danych
            $db = new SQLite3("inzynieria.db");

            // Zabezpiecz dane przed wstrzykiwaniem SQL
            $email = $db->escapeString($email);

            // Sprawdź dane logowania w bazie danych
            $query = "SELECT * FROM users WHERE email='$email'";
            $result = $db->query($query);

            // Sprawdź, czy użytkownik istnieje i hasło się zgadza
            if ($row = $result->fetchArray()) {
                $storedPasswordHash = $row["password_hash"];
                if (password_verify($password, $storedPasswordHash)) {
                    // Pomyślne uwierzytelnienie - możesz wykonać dalsze operacje, np. przekierowanie na inną stronę
                    echo "Logowanie pomyślne!";
                    // Przekieruj na inną stronę
                    session_start();
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $row['user_id']; // Jeśli masz identyfikator użytkownika w tabeli, to możesz go też zapisać w sesji

                    exit(); // Zakończ skrypt po przekierowaniu
                } else {
                    // Nieprawidłowe hasło
                    echo "Nieprawidłowe hasło!";
                }
            } else {
                // Użytkownik nie istnieje
                echo "Użytkownik nie istnieje!";
            }

            // Zamknij połączenie z bazą danych
            $db->close();
        }
        ?>

        <main>
            <div class="main_wrap">
                <div class="login_box">
                    <h2>logowanie</h2>
                    <form method="POST" action="#">
                        <label for="email">wpisz e-mail:</label>
                        <input type="email" name="email" id="email">
                        <label for="password">wpisz hasło:</label>
                        <input type="password" name="password" id="password">
                        <input type="submit" value="zaloguj się">
                    </form>
                    <div class="login_options">
                        <p>
                            <a href="resetpass.html">Zapomniałeś(aś) hasła?</a>
                        </p>
                        <span>albo</span>
                        <p>Nie posiadasz konta? <a href="registeraccount.php">ZAREJESTRUJ SIĘ</a></p>
                    </div>
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
                        <input type="checkbox" name="personal-data" id="personal-data" required>
                        <p>Zgadzam się na wykorzystanie danych osobowych zgodnie z Polityką Prywatności</p>
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