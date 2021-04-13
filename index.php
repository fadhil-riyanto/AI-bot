<?php function SERVER_ALAMAT_addr_indez()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    return $protocol . $domainName;
}
$websitelink = 'https://www.developers.eu.org/';
$imagelink = 'assets/doc/img/home.png';
$history = json_decode(file_get_contents('webdata.json'), true);
$ghlink = 'https://github.com/fadhil-riyanto';
$email = 'hi@fadhilriyanto.eu.org';
$apilink = SERVER_ALAMAT_addr_indez() . '/docs'; ?><!doctypehtml>
    <html lang="en">

    <head>
        <title>Fadhil Riyanto</title>
        <meta charset="UTF-8">
        <meta content="width=device-width,initial-scale=1" name="viewport">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
        <link href="assets/doc/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/doc/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/doc/css/themify-icons.css" rel="stylesheet">
        <link href="assets/doc/css/animate.min.css" rel="stylesheet">
        <link href="assets/doc/css/magnific-popup.css" rel="stylesheet">
        <link href="assets/doc/css/owl.carousel.min.css" rel="stylesheet">
        <link href="assets/doc/css/style.css" rel="stylesheet">
    </head>

    <body>
        <div id="preloder">
            <div class="loader"></div>
        </div>
        <header class="header-section">
            <div class="container">
                <div class="header-warp"><a href="#" class="site-logo"><img src="assets/doc/img/Fadhil.png"></a>
                    <div class="responsive-switch"><i class="fa fa-bars"></i></div>
                    <nav class="site-menu">
                        <div class="sm-close"><i class="ti-close"></i></div>
                        <ul class="menu-list">
                            <li><a href="#home">Home</a></li>
                            <li><a href="<?= $websitelink ?>">Website</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="<?= $apilink ?>">API</a></li>
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
                    <h2><span id="typed-text"></span></h2>
                </div>
            </div>
            <figure class="shap-image"><img src="assets/doc/img/hero-shap.png" alt=""></figure>
        </section>
        <section class="spad about-section" id="about">
            <div class="container">
                <div class="row">
                    <div class="wow fadeInUp col-lg-6" data-wow-delay="0.3s">
                        <figure><img src="<?= $imagelink ?>" alt="Foto"></figure>
                    </div>
                    <div class="wow col-lg-6 about-text fadeInDown" data-wow-delay="0.5s">
                        <div class="about-title">
                            <h2>Memperkenalkan diri</h2>
                            <h5>Siapa saya?</h5>
                        </div>
                        <p>Saya <span>Fadhil Riyanto</span> Seorang manusia yang suka sekali penasaran dan mencoba, saya suka sendirian, dan tenang. saya lebih menyukai pemrograman backend daripada pemrogaman frontend</p>
                        <div class="mt-5 skills">
                            <div class="single-progress-item">
                                <p>Backend Dev (PHP)</p>
                                <div class="progress-bar-style" data-progress="55"></div>
                            </div>
                            <div class="single-progress-item">
                                <p>Backend Dev (Nodejs)</p>
                                <div class="progress-bar-style" data-progress="30"></div>
                            </div>
                            <div class="single-progress-item">
                                <p>Backend Dev (Golang)</p>
                                <div class="progress-bar-style" data-progress="15"></div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <section class="spad resume-section" id="resume">
            <div class="container">
                <div class="section-title">
                    <p>History</p>
                </div>
                <div class="row">
                    <div class="offset-lg-2 col-lg-10 col-xl-9 offset-xl-2"><?php foreach ($history as $hs) {
                                                                                echo '<div class="resume-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="resume-year">
                            <h2>' . $hs['year'] . '</h2>
                        </div>
                        <div class="resume-text">
                            <h3>' . $hs['title'] . '</h3>
                            <p>' . $hs['mini_title'] . '</p>
                        </div>
                    </div>';
                                                                            } ?></div>
                </div>
            </div>
        </section>
        <section class="spad portfolio-section" id="works">
            <div class="container">
                <div class="section-title">
                    <p>Proyek</p>
                    <h2>Bisa kalian lihat di github</h2>
                </div>
                <div class="mt-5 text-center"><a href="<?= $ghlink ?>" class="wow fadeInUp site-btn" data-wow-delay="0.2s">More Projects</a></div>
            </div>
        </section>
        <section class="spad contact-section" id="contact">
            <div class="container">
                <div class="section-title">
                    <p>Contact</p>
                    <h2>Get in touch</h2>
                </div>
                <div class="row">
                    <div class="offset-lg-2 col-lg-8">
                        <div class="row">
                            <div class="wow fadeInUp col-sm-4 cont-info" data-wow-delay="0.6s"><i class="ti-themify-favicon"></i> <span><a href="http://t.me/fadhil_riyanto">@fadhil_riyanto</span>
                                <p>Telegram</p>
                            </div>
                            <div class="wow fadeInUp col-sm-4 cont-info" data-wow-delay="0.2s"><i class="ti-email"></i> <a href="mailto:<?= $email ?>"><span style="unicode-bidi:bidi-override;direction:ltl"><?= $email ?></span></a>
                                <p>email</p>
                            </div>
                            <div class="wow fadeInUp col-sm-4 cont-info" data-wow-delay="0.4s"><i class="ti-github"></i> <span>">@fadhil_riyanto</span>
                                <p>Github</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="spad footer-section set-bg" data-setbg="assets/doc/img/footer-bg.svg">
            <div class="container">
                <div></div>
                <p class="copyright">Copyright © 2020 Fadhil Riyanto<br>All rights Reserved</p>
            </div>
        </footer>
        <script src="assets/doc/js/jquery-2.1.4.min.js"></script>
        <script src="assets/doc/js/jquery.nav.min.js"></script>
        <script src="assets/doc/js/isotope.pkgd.min.js"></script>
        <script src="assets/doc/js/owl.carousel.min.js"></script>
        <script src="assets/doc/js/magnific-popup.min.js"></script>
        <script src="assets/doc/js/wow.min.js"></script>
        <script src="assets/doc/js/typed.min.js"></script>
        <script src="assets/doc/js/scripts.js"></script>
        <script src="assets/doc/js/bubble.js"></script>
        <script src="assets/doc/js/init-bubble.js"></script>
    </body>

    </html>