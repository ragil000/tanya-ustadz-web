<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title -->
        <title>Tanya Ustadz</title>

        <!-- Favicon -->
        <link rel="icon" href="<?=base_url()?>depan/img/core-img/favicon.ico">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="<?=base_url()?>depan/style.css">

        <!-- SIM editor -->
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>depan/node_modules/simditor/styles/simditor.css" />

        <!-- jQuery-2.2.4 js -->
        <script src="<?=base_url()?>depan/js/jquery/jquery-2.2.4.min.js"></script>

    </head>

    <body>
        <!-- Preloader -->
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <!-- ##### Header Area Start ##### -->
        <header class="header-area">
            <!-- Top Header Area -->
            <div class="top-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <!-- Breaking News Widget -->
                            <div class="breaking-news-area d-flex align-items-center">
                                <div class="news-title">
                                    <p>Berita terbaru:</p>
                                </div>
                                <div id="breakingNewsTicker" class="ticker">
                                    <ul>
                                        <li><a href="#">10 Things Amazon Echo Can Do</a></li>
                                        <li><a href="#">Welcome to Colorlib Family.</a></li>
                                        <li><a href="#">Boys 'doing well' after Thai</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="top-meta-data d-flex align-items-center justify-content-end">
                                <!-- Top Social Info -->
                                <div class="top-social-info">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                </div>
                                <!-- Top Search Area -->
                                <div class="top-search-area">
                                    <form action="#" method="post">
                                        <input type="search" name="top-search" id="topSearch" placeholder="cari artikel...">
                                        <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                                <!-- Login -->
                                <a href="#" class="login-btn"><i class="fa fa-user" aria-hidden="true"></i> <?=@$_SESSION['tb_akun_username']?></a>
                            </div>
                        </div>x`
                    </div>
                </div>
            </div>

            <!-- Navbar Area -->
            <div class="vizew-main-menu" id="sticker">
                <div class="classy-nav-container breakpoint-off">
                    <div class="container">

                        <!-- Menu -->
                        <nav class="classy-navbar justify-content-between" id="vizewNav">

                            <!-- Nav brand -->
                            <a href="index.html" class="nav-brand"><img src="<?=base_url()?>depan/img/core-img/logo.png" alt=""></a>

                            <!-- Navbar Toggler -->
                            <div class="classy-navbar-toggler">
                                <span class="navbarToggler"><span></span><span></span><span></span></span>
                            </div>

                            <div class="classy-menu">

                                <!-- Close Button -->
                                <div class="classycloseIcon">
                                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                                </div>

                                <!-- Nav Start -->
                                <div class="classynav">
                                    <ul>
                                        <li class="<?=$berandaActive?>"><a href="<?=base_url()?>user/beranda">Beranda</a></li>
                                        <?php
                                            if(@$_SESSION['tb_akun_level']){
                                                if($_SESSION['tb_akun_level'] == '0'){
                                        ?>
                                        <li class="<?=$pertanyaanSayaActive?>"><a href="<?=base_url()?>user/pertanyaan-saya">Pertanyaan Saya</a></li>
                                        <?php
                                                }else if($_SESSION['tb_akun_level'] == '1'){
                                        ?>
                                        <li class="<?=$pertanyaanSayaActive?>"><a href="<?=base_url()?>user/pertanyaan-saya">Pertanyaan Saya</a></li>
                                        <?php
                                                }else if($_SESSION['tb_akun_level'] == '2'){
                                        ?>
                                        <li class="<?=$pertanyaanMasukActive?>"><a href="<?=base_url()?>ustadz/pertanyaan-masuk">Pertanyaan Masuk</a></li>
                                        <li class="<?=$jawabanSayaActive?>"><a href="<?=base_url()?>ustadz/jawaban-saya">Jawaban Saya</a></li>
                                        <?php
                                                }else if($_SESSION['tb_akun_level'] == '3'){
                                        ?>
                                        <li class="<?=$pertanyaanSayaActive?>"><a href="<?=base_url()?>user/pertanyaan-saya">Pertanyaan Saya</a></li>
                                        <?php
                                                }
                                            }
                                        ?>
                                        <li><a href="#">Berita</a></li>
                                        <li><a href="#">Artikel</a></li>
                                        <li><a href="#">Tentang Web</a></li>
                                    </ul>
                                </div>
                                <!-- Nav End -->
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- ##### Header Area End ##### -->
