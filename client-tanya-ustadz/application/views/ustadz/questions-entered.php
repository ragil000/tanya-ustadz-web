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
                        $tanggal = '';
                        foreach($data['data'] as $result){
                            $tanggal = $RMY->_dateIND($result['tb_pertanyaan_tgl']);
                    ?>

                    <!-- Pertanyaan baru dikirim -->
                    <div class="single-post-area mb-30">
                        <div class="row align-items-center">
                            
                            <div class="col-12 col-lg-12 bg-darkself shadow">
                                <a href="#" class="btn-modal-question-detail" id_tb_pertanyaan="<?=$result['id_tb_pertanyaan']?>">
                                    <blockquote class="vizew-blockquote pb-1 pt-2 mb-1 mbg-danger">
                                    <p><?=$tanggal?></p>
                                        <h5 class="blockquote-text">"<?=$RMY-> _splitText($result['tb_pertanyaan_isi'], $limit = 100)?>”</h5>                                    
                                    </blockquote>
                                </a>
                                <div class="row">
                                    <div class="container mb-3 pt-0 pb-0">
                                        <a href="<?=base_url()?>ustadz/jawaban-saya/<?=$result['id_tb_pertanyaan']?>" class="post-cata cata-sm cata-success mb-0 right">Jawab</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        }
                    ?>
                  
                    <!-- modal lihat pertanyaan -->
                    <div class="modal fade" id="modal-question-detail" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content bg-lightgradient">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark">Detail Pertanyaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p id="question-detail">Modal body text goes here.</p>
                                </div>
                                <div class="modal-footer">
                                <a href="#" id="btn-question-detail" class="btn btn-success btn-sm pl-4 pr-4">Jawab</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal lihat pertanyaan -->

                </div>
            </div>

            <!-- right widget -->
            <div class="col-12 col-md-5 col-lg-4 mt-4">
                <div class="sidebar-area">
                
                    <!-- loader -->
                    <div id="loading-area">
                        <div class="loading">
                            <div class="rectangle_1"></div>
                            <div class="rectangle_2"></div>
                            <div class="rectangle_3"></div>
                            <div class="rectangle_4"></div>
                            <div class="rectangle_5"></div>
                        </div>
                    </div>
                    <!-- end loader -->

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
                        <a href="#"><img src="<?=base_url()?>depan/img/bg-img/add.png" alt=""></a>
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
                                <img src="<?=base_url()?>depan/img/bg-img/25.jpg" alt="">
                            </div>
                            <div class="youtube-channel-content">
                                <a href="single-post.html" class="channel-title">Music Channel</a>
                                <a href="#" class="btn subscribe-btn"><i class="fa fa-play-circle-o" aria-hidden="true"></i> Subscribe</a>
                            </div>
                        </div>

                        <!-- Single YouTube Channel -->
                        <div class="single-youtube-channel d-flex align-items-center">
                            <div class="youtube-channel-thumbnail">
                                <img src="<?=base_url()?>depan/img/bg-img/26.jpg" alt="">
                            </div>
                            <div class="youtube-channel-content">
                                <a href="single-post.html" class="channel-title">Trending Channel</a>
                                <a href="#" class="btn subscribe-btn"><i class="fa fa-play-circle-o" aria-hidden="true"></i> Subscribe</a>
                            </div>
                        </div>

                        <!-- Single YouTube Channel -->
                        <div class="single-youtube-channel d-flex align-items-center">
                            <div class="youtube-channel-thumbnail">
                                <img src="<?=base_url()?>depan/img/bg-img/27.jpg" alt="">
                            </div>
                            <div class="youtube-channel-content">
                                <a href="single-post.html" class="channel-title">Travel Channel</a>
                                <a href="#" class="btn subscribe-btn"><i class="fa fa-play-circle-o" aria-hidden="true"></i> Subscribe</a>
                            </div>
                        </div>

                        <!-- Single YouTube Channel -->
                        <div class="single-youtube-channel d-flex align-items-center">
                            <div class="youtube-channel-thumbnail">
                                <img src="<?=base_url()?>depan/img/bg-img/28.jpg" alt="">
                            </div>
                            <div class="youtube-channel-content">
                                <a href="single-post.html" class="channel-title">Sport Channel</a>
                                <a href="#" class="btn subscribe-btn"><i class="fa fa-play-circle-o" aria-hidden="true"></i> Subscribe</a>
                            </div>
                        </div>

                        <!-- Single YouTube Channel -->
                        <div class="single-youtube-channel d-flex align-items-center">
                            <div class="youtube-channel-thumbnail">
                                <img src="<?=base_url()?>depan/img/bg-img/29.jpg" alt="">
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
                                <img src="<?=base_url()?>depan/img/bg-img/1.jpg" alt="">
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
                                <img src="<?=base_url()?>depan/img/bg-img/2.jpg" alt="">
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
                                <img src="<?=base_url()?>depan/img/bg-img/36.jpg" alt="">
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
                                <img src="<?=base_url()?>depan/img/bg-img/37.jpg" alt="">
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
                                <img src="<?=base_url()?>depan/img/bg-img/38.jpg" alt="">
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

<script type="text/javascript">
    let a = true;
    $('#loading-area').show();
    if(a == false){
        $('#loading-area').hide();
    }

    $('.btn-modal-question-detail').click(function(){
        
        $('#modal-question-detail').modal('show');

        let id_tb_pertanyaan = $(this).attr('id_tb_pertanyaan');
        let link_answer = "<?=base_url()?>ustadz/jawaban-saya/"+id_tb_pertanyaan;
        $.get("<?=base_url()?>ustadz/getQuestionEnteredById/"+id_tb_pertanyaan, function(data) {
            let result = JSON.parse(data);
            result.data.forEach(element => {
                $('#question-detail').text(element.tb_pertanyaan_isi);
                $('#btn-question-detail').attr('href', link_answer);
            });
        });
            // alert(id_tb_pertanyaan);
        
    });

</script>