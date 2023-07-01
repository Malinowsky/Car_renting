
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
                <div class="login_box">
                    <h2>załóż nowe konto</h2>
                    <form method="POST" action="#">
                        <label for="email">wpisz e-mail:</label>
                        <input type="email" name="email" id="email" required>
                        <label for="password">wpisz hasło:</label>
                        <input type="password" name="password" id="password">
                        <label for="confirm-password">potwierdź hasło:</label>
                        <input type="password" name="confirm-password" id="confirm-password">
                        <input type="submit" value="zarejestruj się">
                    </form>
                    <div class="login_options">
                        <p>Czy masz już konto? <a href="login.php">ZALOGUJ SIĘ</a></p>
                    </div>
                </div>
            </div>
        </main>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Pobierz dane z formularza
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm-password"];

            // Sprawdzenie, czy hasła są zgodne
            if ($password !== $confirmPassword) {
                echo '<script>alert("Hasła nie są zgodne!");</script>';
            } else {
                // Sprawdzenie, czy hasło spełnia kryteria (min. 8 znaków, duża litera, mała litera, cyfra, znak specjalny)
                $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
                if (!preg_match($regex, $password)) {
                    echo '<script>alert("Hasło musi zawierać co najmniej 8 znaków, w tym dużą literę, małą literę, cyfrę i znak specjalny!");</script>';
                } else {
                    // Połącz z bazą danych
                    $db = new SQLite3("inzynieria.db");

                    // Zabezpiecz dane przed wstrzykiwaniem SQL
                    $email = $db->escapeString($email);
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                    // Wstaw nowe konto do bazy danych
                    $query = "INSERT INTO users (email, password_hash) VALUES ('$email', '$passwordHash')";
                    $db->exec($query);

                    // Zamknij połączenie z bazą danych
                    $db->close();

                    echo '<script>alert("Rejestracja zakończona powodzeniem!");</script>';
                }
            }
        }
        ?>


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
                        <p>Zgadzam się na wykorzystanie
                        danych osobowych zgodnie z Polityką Prywatności</p>
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