<?php
    $CI =& get_instance();
    $RMY = $CI->LibraryRMYModel;
?>

<!-- ##### Post Details Area Start ##### -->
<section class="post-details-area mb-80">
    <div class="container">
        <div class="row">
            <div class="col-2">
                
            </div>
            <div class="col-8">
                <div class="post-details-thumb mb-50 mt-50">
                    <img src="<?=base_url()?>assets/img/post/<?=$data['data'][0]['tb_jawaban_gambar']?>" alt="single post">
                </div>
            </div>
            <div class="col-2">
                
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Post Details Content Area -->
            <div class="col-12 col-lg-8 col-xl-7">
                <div class="post-details-content">
                    <!-- Blog Content -->
                    <div class="blog-content card pl-4 pr-4 pt-4 pb-4">
                        <?php
                            if(@$id_tb_pertanyaan){
                        ?>
                        <a href="<?=base_url()?>user/sudah-terjawab/<?=$id_tb_pertanyaan?>/<?=$data['data'][0]['id_tb_penjawab']?>" class="post-cata cata-sm cata-success">Sudah Terjawab</a>
                        <?php
                            }
                        ?>
                        <!-- Post Content -->
                        <div class="post-content mt-0">
                            <!-- <a href="#" class="post-cata cata-sm cata-danger">Game</a> -->
                            
                            <?php
                                if($data['data'][0]['tb_jawaban_judul'] != '' || $data['data'][0]['tb_jawaban_judul'] != null){
                            ?>
                            <a href="#" class="post-title mb-2 text-black"><?=$data['data'][0]['tb_jawaban_judul']?></a>
                            <?php
                                }
                            ?>

                            <!-- Pertanyaan -->
                            <div class="single-post-area mb-30">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-12">
                                    <blockquote class="vizew-blockquote mb-15">
                                        <h5 class="blockquote-text">"<?=$data['data'][0]['tb_pertanyaan_isi']?>”</h5>
                                        <h6 class="text-red"><?=$RMY->_dateIND($data['data'][0]['tb_pertanyaan_tgl'])?></h6>
                                    </blockquote>
                                </div>
                            </div>
                            </div>

                            <div class="d-flex justify-content-between mb-30">
                                <div class="post-meta d-flex align-items-center">
                                    <a href="#" class="post-author">Dijawab oleh <?=$data['data'][0]['tb_akun_detail_nama']?></a>
                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                    <a href="#" class="post-date"><?=$RMY->_dateIND($data['data'][0]['tb_penjawab_tgl'])?></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-black">
                            <?=$data['data'][0]['tb_jawaban_isi']?>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ##### Post Details Area End ##### -->