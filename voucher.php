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
    <link rel="stylesheet" href="css/howworks.css">
    <link rel="stylesheet" href="css/voucher.css">
    
    <!-- tablet styles -->
    <link rel="stylesheet" href="css/main-tablet.css">
    <link rel="stylesheet" href="css/howworks-tablet.css">
    <link rel="stylesheet" href="css/voucher-tablet.css">

    <!-- PC styles -->
    <link rel="stylesheet" href="css/main-pc.css">
    <link rel="stylesheet" href="css/howworks-pc.css">
    <link rel="stylesheet" href="css/voucher-pc.css">

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


        <article>
            <div class="bg_img">
                <!-- background img in CSS -->
            </div>
            <div class="how_works_desc">
                <h2>Idealny kupon podarunkowy</h2>
                <p>Jeśli szukasz pomysłu na prezent dla miłośnika motoryzacji i chcesz, aby obdarowana osoba zapamiętała go na długo - nasz voucher upominkowy będzie idealnym wyborem. Oferowane przez nas vouchery obejmują indywidualnie dopasowane usługi na dowolną kwotę - możesz więc wybrać rozwiązanie, które w pełni odpowiada Twoim potrzebom i preferencjom obdarowanej osoby. </p>
                <p> Można je kupić od ręki, bez wychodzenia z domu - wszystkie niezbędne formalności związane z zakupem można załatwić online. Jesteśmy pewni, że każdy fan motoryzacji będzie zachwycony takim prezentem - czy może być coś lepszego niż wypożyczenie samochodu marzeń? </p>
            </div>
            <div class="voucher_wrapper">
                <div class="voucher">
                    <h2>bon na samochód</h2>
                    <div class="voucher_amount">
                        <h2>Bon 300 zł</h2>
                        <input type="submit" value="KUP">
                    </div>
                </div>
                <div class="voucher">
                    <h2>bon na samochód</h2>
                    <div class="voucher_amount">
                        <h2>Bon 300 zł</h2>
                        <input type="submit" value="KUP">
                    </div>
                </div>
            </div>
            <div class="bg_img">
                <!-- background img in CSS -->
            </div>
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