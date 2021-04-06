<?php
$websitelink = 'https://www.developers.eu.org/';
$imagelink = 'assets/doc/img/home.png';
$history = json_decode(file_get_contents('webdata.json'), true);
$ghlink = 'https://github.com/fadhil-riyanto';
$email = 'hi@fadhilriyanto.eu.org';
$apilink = 'https://fadhilapisss.docs.apiary.io/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fadhil Riyanto</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/doc/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/doc/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/doc/css/themify-icons.css" />
    <link rel="stylesheet" href="assets/doc/css/animate.min.css" />
    <link rel="stylesheet" href="assets/doc/css/magnific-popup.css" />
    <link rel="stylesheet" href="assets/doc/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/doc/css/style.css" />
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <header class="header-section">
        <div class="container">
            <div class="header-warp">
                <a href="#" class="site-logo">
                    <img src="assets/doc/img/Fadhil.png">
                </a>
                <div class="responsive-switch"><i class="fa fa-bars"></i></div>
                <nav class="site-menu">
                    <div class="sm-close"><i class="ti-close"></i></div>
                    <ul class="menu-list">
                        <li><a href="#home">Home</a></li>
                        <li><a href="<?= $websitelink; ?>">Website</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="<?= $apilink; ?>">API</a></li>
                        <li><a href="#resume">History</a></li>
                        <li><a href="#works">Proyek</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <section class="hero-section hero-style-three" id="home">
        <div id="bubble"></div>
        <div class="typed-area">
            <div class="container">
                <!-- typed text -->
                <h2><span id="typed-text"></span></h2>
            </div>
        </div>
        <figure class="shap-image">
            <img src="assets/doc/img/hero-shap.png" alt="">
        </figure>
    </section>
    <section class="about-section spad" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <figure>
                        <img src="<?= $imagelink; ?>" alt="Foto">
                    </figure>
                </div>
                <div class="col-lg-6 about-text wow fadeInDown" data-wow-delay="0.5s">
                    <div class="about-title">
                        <h2>Memperkenalkan diri</h2>
                        <h5>Siapa saya?</h5>
                    </div>
                    <p>Saya <span>Fadhil Riyanto</span> Seorang manusia yang suka sekali penasaran dan mencoba, saya suka sendirian, dan tenang. saya lebih menyukai pemrograman backend daripada pemrogaman frontend </p>
                    <div class="skills mt-5">
                        <!-- Skill item -->
                        <div class="single-progress-item">
                            <p>Backend Dev (PHP)</p>
                            <div class="progress-bar-style" data-progress="55"></div>
                        </div>
                        <!-- Skill item -->
                        <div class="single-progress-item">
                            <p>Backend Dev (Nodejs)</p>
                            <div class="progress-bar-style" data-progress="30"></div>
                        </div>
                        <!-- Skill item -->
                        <div class="single-progress-item">
                            <p>Backend Dev (Golang)</p>
                            <div class="progress-bar-style" data-progress="15"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- services -->

    </section>
    <!-- About section end -->



    <!-- Resume section start -->
    <section class="resume-section spad" id="resume">
        <div class="container">
            <div class="section-title">
                <p>History</p>
            </div>
            <div class="row">
                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-2">
                    <!-- Review item -->


                    <?php
                    foreach ($history as $hs) {
                        echo '<div class="resume-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="resume-year">
                            <h2>' . $hs['year'] . '</h2>
                        </div>
                        <div class="resume-text">
                            <h3>' . $hs['title'] . '</h3>
                            <p>' . $hs['mini_title'] . '</p>
                        </div>
                    </div>';
                    }
                    ?>
                    <!-- Review item -->

                </div>
            </div>
        </div>
    </section>
    <!-- Resume section end -->



    <!-- Portfolio section start -->
    <section class="portfolio-section spad" id="works">
        <div class="container">
            <div class="section-title">
                <p>Proyek</p>
                <h2>Bisa kalian lihat di github</h2>
            </div>
            <div class="text-center mt-5">
                <a href="<?= $ghlink; ?>" class="site-btn wow fadeInUp" data-wow-delay="0.2s">More Projects</a>
            </div>
        </div>
    </section>
    <!-- Portfolio section end -->


    <!-- Contact section start -->
    <section class="contact-section spad" id="contact">
        <div class="container">
            <div class="section-title">
                <p>Contact</p>
                <h2>Get in touch</h2>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="row">
                        <!-- contact info -->
                        <div class="col-sm-4 cont-info wow fadeInUp" data-wow-delay="0.6s">
                            <i class="ti-themify-favicon"></i>
                            <span><a href="http://t.me/fadhil_riyanto">@fadhil_riyanto</span>
                            <p>Telegram</p>
                        </div>
                        <!-- contact info -->
                        <div class="col-sm-4 cont-info wow fadeInUp" data-wow-delay="0.2s">
                            <i class="ti-email"></i>
                            <a href="mailto:<?= $email; ?>"><span style="unicode-bidi:bidi-override; direction: ltl;"><?= $email; ?></span></a>
                            <p>email</p>
                        </div>
                        <!-- contact info -->
                        <div class="col-sm-4 cont-info wow fadeInUp" data-wow-delay="0.4s">
                            <i class="ti-github"></i>
                            <span>
                                <!--<a href="<?= $ghlink; ?>-->">@fadhil_riyanto</span>
                            <p>Github</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact section end -->


    <!-- Footer section start -->
    <footer class="footer-section spad set-bg" data-setbg="assets/doc/img/footer-bg.svg">
        <div class="container">
            <div></div>
            <!-- copyright -->
            <p class="copyright">Copyright &copy; 2020 Fadhil Riyanto<br />All rights Reserved</p>
        </div>
    </footer>
    <!-- Footer section end -->


    <!--====== Jquery & Javascripts files  ======-->
    <script src="assets/doc/js/jquery-2.1.4.min.js"></script>
    <script src="assets/doc/js/jquery.nav.min.js"></script>
    <script src="assets/doc/js/isotope.pkgd.min.js"></script>
    <script src="assets/doc/js/owl.carousel.min.js"></script>
    <script src="assets/doc/js/magnific-popup.min.js"></script>
    <script src="assets/doc/js/wow.min.js"></script>
    <script src="assets/doc/js/typed.min.js"></script>
    <script src="assets/doc/js/scripts.js"></script>

    <!-- For bubble style -->
    <script src="assets/doc/js/bubble.js"></script>
    <script src="assets/doc/js/init-bubble.js"></script>

</body>

</html>