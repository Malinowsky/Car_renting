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

    <!-- tablet styles -->
    <link rel="stylesheet" href="css/main-tablet.css">
    <link rel="stylesheet" href="css/cars-tablet.css">

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
                <a href="cars.html">zarezerwuj</a>
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

        <form class="filter_form" action="cars.php" method="get" id="filterForm">
            <h2>Filtruj według kraju pochodzenia:</h2>
            <div class="country_tilter_wrap">
                <div class="country_tilter_1col">
                    <input type="checkbox" name="country_of_origin[]" value="Italy"> Włochy<br>
                    <input type="checkbox" name="country_of_origin[]" value="USA"> USA<br>
                    <input type="checkbox" name="country_of_origin[]" value="Germany"> Niemcy<br>
                    <input type="checkbox" name="country_of_origin[]" value="UK"> Wielka Brytania<br>
                </div>
                <div class="country_tilter_2col">
                    <input type="checkbox" name="country_of_origin[]" value="Japan"> Japonia<br>
                    <input type="checkbox" name="country_of_origin[]" value="France"> Francja<br>
                    <input type="checkbox" name="country_of_origin[]" value="Sweden"> Szwecja<br>
                </div>
            </div>

            <h2>Sortuj według:</h2>
            <select class="sort_by" name="sort_by">
                <option value="price_asc">Cena (rosnąco)</option>
                <option value="price_desc">Cena (malejąco)</option>
                <option value="power_asc">Moc (rosnąco)</option>
                <option value="power_desc">Moc (malejąco)</option>
            </select>

            <input type="submit" value="Filtruj">
        </form>


        <article>
            <?php
            try {
                $db = new PDO('sqlite:inzynieria.db');
            } catch (PDOException $e) {
                echo "Błąd połączenia z bazą danych: " . $e->getMessage();
                exit();
            }

            $query = "SELECT * FROM cars";

            // Filtruj według kraju pochodzenia
            if (isset($_GET['country_of_origin'])) {
                $countries = $_GET['country_of_origin'];
                $placeholders = implode(',', array_fill(0, count($countries), '?'));
                $query .= " WHERE country_of_origin IN ($placeholders)";
            }

            // Sortuj według wybranej opcji
            if (isset($_GET['sort_by'])) {
                $sortOption = $_GET['sort_by'];
                if ($sortOption == 'price_asc') {
                    $query .= " ORDER BY daily_rate ASC";
                } elseif ($sortOption == 'price_desc') {
                    $query .= " ORDER BY daily_rate DESC";
                } elseif ($sortOption == 'power_asc') {
                    $query .= " ORDER BY horsepower ASC";
                } elseif ($sortOption == 'power_desc') {
                    $query .= " ORDER BY horsepower DESC";
                }
            }

            $stmt = $db->prepare($query);

            // Jeśli filtr krajów pochodzenia jest ustawiony, przekaż parametry do zapytania
            if (isset($_GET['country_of_origin'])) {
                $stmt->execute($countries);
            } else {
                $stmt->execute();
            }


  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $row["car_id"];
    $make = $row['make'];
    $model = $row['model'];
    $full_name = $make . ' ' . $model;

    $image = $row['image'];
    $horsepower = $row['horsepower'];
    $acceleration = $row['acceleration_0_to_100'];
    $transmission = $row['transmission_type'];
    $daily_rate = $row['daily_rate']; // Pobierz cenę dziennego wynajmu

    echo '<div class="car">';
    echo '    <div class="car_photo">';
    echo '        <a href="cars-html/lamboEvo.html"><img src="' . $image . '" alt="' . $full_name . '"></a>';
    echo '    </div>';
    echo '    <div class="car_info">';
    echo '        <h2>' . $full_name . '</h2>';
    echo '        <div class="short_info">';
    echo '              <div class="short_info_elemet_up">';
    echo '                  <div class="short_info_element">';
    echo '                      <i class="fa-solid fa-wrench"></i> <p>' . $horsepower . 'km</p>';
    echo '                  </div>';
    echo '                  <div class="short_info_element">';
    echo '                      <i class="fa-solid fa-gauge"></i> <p>' . $acceleration . 's do 100km/h</p>';
    echo '                  </div>';
    echo '                  <div class="short_info_element">';
    echo '                      <i class="fa-sharp fa-solid fa-gears"></i> <p>' . $transmission . '</p>';
    echo '                  </div>';
    echo '              </div>';
    echo '              <div class="short_info_elemet_down">';
    echo '                  <div class="short_info_element">'; // Dodatkowy element dla ceny dziennego wynajmu
    echo '                      <i class="fa-solid fa-coins"></i> <p>' . $daily_rate . ' zł dziennie</p>';
    echo '                  </div>';
    echo '                  <a href="rent.php?car_id=',$id,'"><button class="blue_button">Wypożycz</button></a>';
    echo '              </div>';
    echo '        </div>';
    echo '    </div>';
    echo '</div>';
}

?>

        </article>

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