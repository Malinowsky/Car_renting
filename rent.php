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
    <link rel="stylesheet" href="css/cars.css">
    <link rel="stylesheet" href="css/car-single.css">

    <!-- tablet styles -->
    <link rel="stylesheet" href="css/main-tablet.css">
    <link rel="stylesheet" href="css/cars-tablet.css">
    <link rel="stylesheet" href="css/car-single-tablet.css">

    <!-- PC styles -->
    <link rel="stylesheet" href="css/main-pc.css">
    <link rel="stylesheet" href="css/cars-pc.css">
    <link rel="stylesheet" href="css/car-single-pc.css">

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
        
        <?php
            session_start();
            if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
                echo '<script>alert("Pamiętaj że musisz się zalogować przed wypożyczeniem auta!");</script>';
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
        //    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

            // Pobierz ID samochodu
            $car_id = $_GET['car_id'];

            // Pobierz dane samochodu z bazy danych
            $query = "SELECT * FROM cars WHERE car_id = :car_id";
            $stmt = $db->prepare($query);
            $stmt->execute(['car_id' => $car_id]);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                $id = $row["car_id"];
                $make = $row['make'];
                $model = $row['model'];
                $full_name = $make . ' ' . $model;

                $image = $row['image'];
                $horsepower = $row['horsepower'];
                $acceleration = $row['acceleration_0_to_100'];
                $transmission = $row['transmission_type'];
                $daily_rate = $row['daily_rate'];
                $engine_capacity = $row['engine_capacity'];
        ?>
        <article>
            <div class="car">
                <div class="car_photo">
                    <img src="<?php echo $image; ?>" alt="<?php echo $full_name; ?>">
                </div>
                <div class="car_info car_info_single">
                    <h2><?php echo $full_name; ?></h2>
                    <div class="short_info">
                        <div class="short_info_element">
                            <i class="fa-solid fa-wrench"></i>
                            <p><?php echo $horsepower; ?>KM</p>
                        </div>
                        <div class="short_info_element">
                            <i class="fa-solid fa-gauge"></i>
                            <p><?php echo $acceleration; ?>s do 100km/h</p>
                        </div>
                        <div class="short_info_element">
                            <i class="fa-sharp fa-solid fa-gears"></i>
                            <p><?php echo $transmission; ?></p>
                        </div>
                    </div>
                    <div class="go_to_buttons">
                        <a href="#car_description" class="a_button_style">OPIS SAMOCHODU</a>
                        <a href="#car_data" class="a_button_style">DANE TECHNICZNE</a>
                        <?php
                        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                            echo '<a href="#car_reservation" class="a_button_style">REZERWACJA</a>';
                        }
                        ?>
                        <div id="car_description" class="car_description">
                            <p>Lamborghini przy projektowaniu modelu Huracan Evo skupiło się na dopracowaniu istniejącej konstrukcji. Celem włoskiego producenta było poprawienie parametrów auta, z jednoczesnym uzyskaniem jeszcze większej ilości adrenaliny z jego prowadzenia. Model Huracan bazuje na wersji Performante, dzięki czemu m.in. uzyskuje dodatkowe 30KM i 40Nm względem „zwykłego” Huracana. To oczywiście nie wszystkie zmiany jakie przeszedł ten samochód.</p>
                        </div>
                    </div>

                    <div id="car_data" class="car_data">
                    <span class="car_data_boxes">
                        <p>Moc</p>
                        <p><?php echo $horsepower; ?>KM</p>
                    </span>
                        <span class="car_data_boxes">
                        <p>0-100</p>
                        <p><?php echo $acceleration; ?>s</p>
                    </span>
                        <span class="car_data_boxes">
                        <p>Skrzynia</p>
                        <p><?php echo $transmission; ?></p>
                    </span>
                        <span class="car_data_boxes">
                        <p>Silnik</p>
                        <p><?php echo $engine_capacity; ?>L</p>
                    </span>
                        </span>
                        <span class="car_data_boxes">
                        <p>Cena za dobę</p>
                        <p><?php echo $daily_rate; ?> ZŁ</p>
                    </span>
                    </div>
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        echo '<div id="car_reservation" class="car_reservation">
                    <form action="process_rental.php" method="post">
                        <input type="hidden" name="car_id" value="' . $car_id . '">
                        <label for="phone"> Numer telefonu: </label>
                        <input type="tel" id="phone" name="phone" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" required><br>
                        <label for="full_name"> Imię i nazwisko: </label>
                        <input type="text" name="full_name" required><br>
                        <label for="start_date"> Data początku: </label> 
                        <input type="date" name="start_date" required><br>
                        <label for="end_date"> Data końca: </label> 
                        <input type="date" name="end_date" required><br>
                        <input type="submit" value="Wypożycz">
                    </form>
                  </div>';

                    }
                    ?>


                </div>


            </div>
        </article>
    <?php endwhile; ?>

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

