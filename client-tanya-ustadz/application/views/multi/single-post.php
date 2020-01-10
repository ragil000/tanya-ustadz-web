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
                                    <a href="#" class="btn-modal-question-detail" id_tb_akun_detail="<?=$data['data'][0]['id_tb_akun_detail']?>" class="post-author">Dijawab oleh <?=$data['data'][0]['tb_akun_detail_nama']?></a>
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

            <!-- modal lihat Ustadz -->
            <div class="modal fade" id="modal-question-detail" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-lightgradient">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark">Detail Ustadz</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-black" id="ustadz-name">Aku</h4>
                            <p class="text-dark" id="ustadz-detail">Modal body text goes here.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal lihat Ustadz -->
        
        </div>
    </div>
</section>
<!-- ##### Post Details Area End ##### -->

<script>
    let obj = $("[xss='removed']");

    obj.addClass('text-black');

    // click detail question
    $('.btn-modal-question-detail').click(function(){
            
            $('#modal-question-detail').modal('show');

            let id_tb_akun_detail = $(this).attr('id_tb_akun_detail');
            $.get("<?=base_url()?>multi/single-post/detail-ustadz/"+id_tb_akun_detail, function(data) {
                let result = JSON.parse(data);
                result.data.forEach(element => {
                    $('#ustadz-name').text(element.tb_akun_detail_nama);
                    $('#ustadz-detail').text(element.tb_akun_detail_deskripsi);
                });
            });
            
        });
        // end click detail question
</script>