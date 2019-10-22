<?php
    $CI =& get_instance();
    $RMY = $CI->LibraryRMYModel;
?>
<!-- ##### Vizew Post Area Start ##### -->
<section class="vizew-post-area mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-8">
                <div class="all-posts-area">

                    <!-- Section Heading -->
                    <div class="section-heading style-2 mt-4">
                        <h4>Pertanyaan Anda</h4>
                        <div class="line"></div>
                    </div>
                    
                    <?php
                        $formQuestionHidden = '';
                        $questionHidden = 'hidden';
                        $qestionAnswersHidden = '';
                        $qestionRangkingHidden = 'hidden';
                        $question = '';
                        $tanggal = '';
                        foreach($data['data'] as $result){
                            if($result['tb_pertanyaan_level'] === '0'){
                                $formQuestionHidden = 'hidden';
                                $questionHidden = '';
                                $qestionAnswersHidden = 'hidden';
                                $qestionRangkingHidden = '';
                                $question = $result['tb_pertanyaan_isi'];
                                $tanggal = $RMY->_dateIND($result['tb_pertanyaan_tgl']);
                                break;
                            }
                        }

                        if(@$_SESSION['tb_akun_level']){
                            if($_SESSION['tb_akun_level'] === '0' || $_SESSION['tb_akun_level'] === '1' || $_SESSION['tb_akun_level'] === '2'){
                                $formQuestionHidden = 'hidden';
                                $questionHidden = 'hidden';
                                $qestionAnswersHidden = 'hidden';
                                $qestionRangkingHidden = 'hidden';
                                $question = '';
                                $tanggal = '';
                            }
                        }

                    ?>
                    <!-- Single Post Question -->
                    <div class="single-post-area mb-30" <?=$formQuestionHidden?>>
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <form action="">
                                    <!-- <p id="count-question-caracter">250</p> -->
                                    <textarea name="message" class="form-control text-white" id="message" cols="30" rows="10" maxlength="1500"></textarea>
                                    <button type="submit" class="btn vizew-btn w-100">Kirim Pertanyaan</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Pertanyaan baru dikirim -->
                    <div class="single-post-area mb-30" <?=$questionHidden?>>
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <blockquote class="vizew-blockquote mb-15">
                                    <h5 class="blockquote-text">"<?=$question?>”</h5>
                                    <h6><?=$tanggal?></h6>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar rangking saran jawaban -->
                    <div <?=$qestionRangkingHidden?>>
                        <div class="section-heading style-1 mt-4">
                            <h4>Saran Jawaban</h4>
                            <div class="line"></div>
                        </div>

                        <!-- Single Post Area -->
                        <div class="single-post-area mb-30">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-6">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="<?=base_url()?>depan/img/bg-img/21.jpg" alt="">

                                        <!-- Video Duration -->
                                        <span class="video-duration">05.03</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <!-- Post Content -->
                                    <div class="post-content mt-0">
                                        <a href="#" class="post-cata cata-sm cata-success">Sports</a>
                                        <a href="single-post.html" class="post-title mb-2">May fights on after Johnson savages Brexit approach</a>
                                        <div class="post-meta d-flex align-items-center mb-2">
                                            <a href="#" class="post-author">By Jane</a>
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                            <a href="#" class="post-date">Sep 08, 2018</a>
                                        </div>
                                        <p class="mb-2">Quisque mollis tristique ante. Proin ligula eros, varius id tristique sit amet, rutrum non ligula.</p>
                                        <div class="post-meta d-flex">
                                            <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 32</a>
                                            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 42</a>
                                            <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 7</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Post Area -->
                        <div class="single-post-area mb-30">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-12">
                                    <h5 class="text-center text-default">Belum ada pertanyaan yang sudah dijawab</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Daftar rangking saran jawaban -->
                    
                    <!-- Daftar pertanyaan sudah dijawab -->
                    <div <?=$qestionAnswersHidden?>>
                        <div class="section-heading style-1 mt-4">
                            <h4>Pertanyaan Sudah Dijawab</h4>
                            <div class="line"></div>
                        </div>

                        <!-- Single Post Area -->
                        <div class="single-post-area mb-30">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-6">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="<?=base_url()?>depan/img/bg-img/21.jpg" alt="">

                                        <!-- Video Duration -->
                                        <span class="video-duration">05.03</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <!-- Post Content -->
                                    <div class="post-content mt-0">
                                        <a href="#" class="post-cata cata-sm cata-success">Sports</a>
                                        <a href="single-post.html" class="post-title mb-2">May fights on after Johnson savages Brexit approach</a>
                                        <div class="post-meta d-flex align-items-center mb-2">
                                            <a href="#" class="post-author">By Jane</a>
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                            <a href="#" class="post-date">Sep 08, 2018</a>
                                        </div>
                                        <p class="mb-2">Quisque mollis tristique ante. Proin ligula eros, varius id tristique sit amet, rutrum non ligula.</p>
                                        <div class="post-meta d-flex">
                                            <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 32</a>
                                            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 42</a>
                                            <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 7</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Post Area -->
                        <div class="single-post-area mb-30">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-12">
                                    <h5 class="text-center text-default">Belum ada pertanyaan yang sudah dijawab</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Daftar pertanyaan sudah dijawab -->

                </div>
            </div>

            <!-- right widget -->
            <div class="col-12 col-md-5 col-lg-4 mt-4">
                <div class="sidebar-area">

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget followers-widget mb-50">
                        <a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span class="counter">198</span><span>Fan</span></a>
                        <a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i><span class="counter">220</span><span>Followers</span></a>
                        <a href="#" class="google"><i class="fa fa-google" aria-hidden="true"></i><span class="counter">140</span><span>Subscribe</span></a>
                    </div>

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget latest-video-widget mb-50">
                        
                        <!-- Section Heading -->
                        <div class="section-heading style-2 mb-30">
                            <h4>Belum Dijawab</h4>
                            <div class="line"></div>
                        </div>

                        <!-- Pertanyaan belum dijawab -->
                        <div class="single-post-area mb-30">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-12">
                                    <!-- Post Thumbnail -->
                                    <a href="#">
                                        <div class="card pl-2">
                                            <span class="question-date">23 Januari 2019</span>
                                            <p class="mb-2 text-black">Quisque mollis tristique ante. Proin ligula eros, varius id tristique sit amet, rutrum non ligula...</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Pertanyaan belum dijawab -->
                        <div class="single-post-area mb-30">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-12">
                                    <!-- Post Thumbnail -->
                                    <a href="#">
                                        <div class="card pl-2">
                                            <span class="question-date">23 Januari 2019</span>
                                            <p class="mb-2 text-black">Quisque mollis tristique ante. Proin ligula eros, varius id tristique sit amet, rutrum non ligula...</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget add-widget mb-50">
                        <a href="#"><img src="img/bg-img/add.png" alt=""></a>
                    </div>

                    <!-- ***** Sidebar Widget ***** -->
                    <div class="single-widget youtube-channel-widget mb-50">
                        <!-- Section Heading -->
                        <div class="section-heading style-2 mb-30">
                            <h4>Hot Channels</h4>
                            <div class="line"></div>
                        </div>

                        <!-- Single YouTube Channel -->
                        <div class="single-youtube-channel d-flex align-items-center">
                            <div class="youtube-channel-thumbnail">
                                <img src="img/bg-img/25.jpg" alt="">
                            </div>
                            <div class="youtube-channel-content">
                                <a href="single-post.html" class="channel-title">Music Channel</a>
                                <a href="#" class="btn subscribe-btn"><i class="fa fa-play-circle-o" aria-hidden="true"></i> Subscribe</a>
                            </div>
                        </div>

                        <!-- Single YouTube Channel -->
                        <div class="single-youtube-channel d-flex align-items-center">
                            <div class="youtube-channel-thumbnail">
                                <img src="img/bg-img/26.jpg" alt="">
                            </div>
                            <div class="youtube-channel-content">
                                <a href="single-post.html" class="channel-title">Trending Channel</a>
                                <a href="#" class="btn subscribe-btn"><i class="fa fa-play-circle-o" aria-hidden="true"></i> Subscribe</a>
                            </div>
                        </div>

                        <!-- Single YouTube Channel -->
                        <div class="single-youtube-channel d-flex align-items-center">
                            <div class="youtube-channel-thumbnail">
                                <img src="img/bg-img/27.jpg" alt="">
                            </div>
                            <div class="youtube-channel-content">
                                <a href="single-post.html" class="channel-title">Travel Channel</a>
                                <a href="#" class="btn subscribe-btn"><i class="fa fa-play-circle-o" aria-hidden="true"></i> Subscribe</a>
                            </div>
                        </div>

                        <!-- Single YouTube Channel -->
                        <div class="single-youtube-channel d-flex align-items-center">
                            <div class="youtube-channel-thumbnail">
                                <img src="img/bg-img/28.jpg" alt="">
                            </div>
                            <div class="youtube-channel-content">
                                <a href="single-post.html" class="channel-title">Sport Channel</a>
                                <a href="#" class="btn subscribe-btn"><i class="fa fa-play-circle-o" aria-hidden="true"></i> Subscribe</a>
                            </div>
                        </div>

                        <!-- Single YouTube Channel -->
                        <div class="single-youtube-channel d-flex align-items-center">
                            <div class="youtube-channel-thumbnail">
                                <img src="img/bg-img/29.jpg" alt="">
                            </div>
                            <div class="youtube-channel-content">
                                <a href="single-post.html" class="channel-title">TV Show Channel</a>
                                <a href="#" class="btn subscribe-btn"><i class="fa fa-play-circle-o" aria-hidden="true"></i> Subscribe</a>
                            </div>
                        </div>
                    </div>

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget newsletter-widget mb-50">
                        <!-- Section Heading -->
                        <div class="section-heading style-2 mb-30">
                            <h4>Newsletter</h4>
                            <div class="line"></div>
                        </div>
                        <p>Subscribe our newsletter gor get notification about new updates, information discount, etc.</p>
                        <!-- Newsletter Form -->
                        <div class="newsletter-form">
                            <form action="#" method="post">
                                <input type="email" name="nl-email" class="form-control mb-15" id="emailnl" placeholder="Enter your email">
                                <button type="submit" class="btn vizew-btn w-100">Subscribe</button>
                            </form>
                        </div>
                    </div>

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget mb-50">
                        <!-- Section Heading -->
                        <div class="section-heading style-2 mb-30">
                            <h4>Most Viewed Playlist</h4>
                            <div class="line"></div>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-blog-post d-flex">
                            <div class="post-thumbnail">
                                <img src="img/bg-img/1.jpg" alt="">
                            </div>
                            <div class="post-content">
                                <a href="single-post.html" class="post-title">DC Shoes: gymkhana five; the making of</a>
                                <div class="post-meta d-flex justify-content-between">
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 14</a>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 34</a>
                                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 84</a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-blog-post d-flex">
                            <div class="post-thumbnail">
                                <img src="img/bg-img/2.jpg" alt="">
                            </div>
                            <div class="post-content">
                                <a href="single-post.html" class="post-title">How To Make Orange Chicken Recipe?</a>
                                <div class="post-meta d-flex justify-content-between">
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 14</a>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 34</a>
                                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 84</a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-blog-post d-flex">
                            <div class="post-thumbnail">
                                <img src="img/bg-img/36.jpg" alt="">
                            </div>
                            <div class="post-content">
                                <a href="single-post.html" class="post-title">Sweet Yummy Chocolate in the</a>
                                <div class="post-meta d-flex justify-content-between">
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 14</a>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 34</a>
                                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 84</a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-blog-post d-flex">
                            <div class="post-thumbnail">
                                <img src="img/bg-img/37.jpg" alt="">
                            </div>
                            <div class="post-content">
                                <a href="single-post.html" class="post-title">DC Shoes: gymkhana five; the making of</a>
                                <div class="post-meta d-flex justify-content-between">
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 14</a>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 34</a>
                                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 84</a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-blog-post d-flex">
                            <div class="post-thumbnail">
                                <img src="img/bg-img/38.jpg" alt="">
                            </div>
                            <div class="post-content">
                                <a href="single-post.html" class="post-title">How To Make Orange Chicken Recipe?</a>
                                <div class="post-meta d-flex justify-content-between">
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 14</a>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 34</a>
                                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 84</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Vizew Psot Area End ##### -->