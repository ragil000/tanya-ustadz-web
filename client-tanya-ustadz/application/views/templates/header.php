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

        <!-- sweet alert -->
        <script src="<?=base_url()?>node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

        <!-- jQuery-2.2.4 js -->
        <script src="<?=base_url()?>depan/js/jquery/jquery-2.2.4.min.js"></script>

        <!-- library RMY -->
        <script src="<?=base_url()?>depan/js/RMYLibrary.js"></script>

        <!-- Sim text editor -->
        <script type="text/javascript" src="<?=base_url()?>depan/node_modules/simple-hotkeys/node_modules/simple-module/lib/module.js"></script>
        <script type="text/javascript" src="<?=base_url()?>depan/node_modules/simple-hotkeys/lib/hotkeys.js"></script>
        <script type="text/javascript" src="<?=base_url()?>depan/node_modules/simple-uploader/dist/uploader.js"></script>
        <script type="text/javascript" src="<?=base_url()?>depan/node_modules/simditor/lib/simditor.js"></script>

        <script>
            function startTime() {
                let today = new Date();
                let h = today.getHours();
                let m = today.getMinutes();
                let s = today.getSeconds();
                h = checkTime(h);
                m = checkTime(m);
                s = checkTime(s);
                document.getElementById('set-clock').innerHTML = h + ":" + m + ":" + s;
                let t = setTimeout(startTime, 500);
            }

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }  // add zero in front of numbers < 10
                return i;
            }
        </script>

    </head>

    <body onload="startTime()">
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
                                    <p id="nasehat">Nasehat Indah:</p>
                                </div>
                                <div id="breakingNewsTicker" class="ticker">
                                    <ul>
                                        <li><a href="#">"Tak akan ada yang akan mengerjakan amalmu selain dirimu"</a></li>
                                        <li><a href="#">"Jika bukan sekarang, kapan kamu akan bertobat"</a></li>
                                        <li><a href="#">"Para mayat itu, berharap kesempatan yang kamu sia siakan"</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="top-meta-data d-flex align-items-center justify-content-end">
                                <!-- Top Social Info -->
                                <!-- <div class="top-social-info">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                </div> -->

                                <?php
                                    if(isset($berandaActive)){
                                        if($berandaActive == 'active'){
                                ?>
                                <!-- Top Search Area -->
                                <div class="top-search-area">
                                    <form action="<?=base_url()?>multi/beranda/search" method="post">
                                        <input type="search" name="query_search" id="topSearch" placeholder="cari tanya jawab">
                                        <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                                
                                <?php
                                        }
                                    }
                                ?>

                                <!-- Login -->
                                <?php
                                    if(isset($_SESSION['id_tb_akun'])){
                                ?>
                                <a href="#" class="login-btn"><i class="fa fa-user" aria-hidden="true"></i> <?=@$_SESSION['tb_akun_username']?></a>
                                <a href="<?=base_url()?>multi/keluar" class="login-btn"><i class="fa fa-sign-out" aria-hidden="true"></i> Keluar</a>
                                <?php
                                    }else{
                                ?>
                                <a href="<?=base_url()?>multi/masuk" class="login-btn"><i class="fa fa-sign-in" aria-hidden="true"></i> Masuk</a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
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
                                        <li class="<?=$berandaActive?>"><a href="<?=base_url()?>multi/beranda">Beranda</a></li>
                                        <?php
                                            if(isset($_SESSION['tb_akun_level'])){
                                                if($_SESSION['tb_akun_level'] == '0'){
                                        ?>
                                        <li class="<?=$dataAkunActive?>"><a href="<?=base_url()?>super/data-akun">Data Akun</a></li>
                                        <!-- <li class="<?=$akunNonaktifActive?>"><a href="<?=base_url()?>super/akun-nonaktif">Akun Nonaktif</a></li> -->
                                        <?php
                                                }else if($_SESSION['tb_akun_level'] == '1'){
                                        ?>
                                        <li class="<?=$jawabanSiapPublisActive?>"><a href="<?=base_url()?>editor/jawaban-siap-publis">Jawaban Siap Publis</a></li>
                                        <li class="<?=$jawabanTerpublisActive?>"><a href="<?=base_url()?>editor/jawaban-terpublis">Jawaban Terpublis</a></li>
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
                                            }else{
                                        ?>
                                       <li class=""><a href="<?=base_url()?>user/pertanyaan-saya">Pertanyaan Saya</a></li>
                                       <?php
                                            }
                                       ?>
                                        <!-- <li><a href="#">Tentang Web</a></li> -->
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
