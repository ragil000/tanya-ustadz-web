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
                    
                    <?php
                        $id_tb_pengedit = null;
                        if(@$dataReady['data']){
                    ?>
                    
                    <!-- Section Answer -->
                    <div class="section-heading style-2 mt-4">
                        <h4>Edit Jawaban Sebelum di Publis</h4>
                        <div class="line"></div>
                    </div>
                    
                    <?php
                        $tb_jawaban_isi = '';
                        foreach($dataReady['data'] as $dataReadyRead){
                            $id_tb_pengedit = $dataReadyRead['id_tb_pengedit'];
                            $id_tb_pertanyaan = $dataReadyRead['id_tb_pertanyaan'];
                            $tb_pertanyaan_isi = $dataReadyRead['tb_pertanyaan_isi'];
                            $id_tb_jawaban = $dataReadyRead['id_tb_jawaban'];
                            $tb_jawaban_judul = $dataReadyRead['tb_jawaban_judul'];
                            $tb_jawaban_isi = $dataReadyRead['tb_jawaban_isi'];
                            $tb_jawaban_gambar = $dataReadyRead['tb_jawaban_gambar'];
                    ?>
                    <!-- Jawaban yang siap di publis -->
                    <div class="single-post-area mb-30">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <blockquote class="vizew-blockquote mb-15">
                                    <h5 class="blockquote-text">"<?=$dataReadyRead['tb_pertanyaan_isi']?>"</h5>
                                    <h6 class="text-red"><?=$RMY->_dateIND($dataReadyRead['tb_pertanyaan_tgl'])?></h6>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>

                    <!-- Form Answer Section -->
                    <div class="single-post-area mb-30" id="form-answer-section">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <form action="<?=base_url()?>editor/put-published-answer" method="POST" enctype="multipart/form-data">
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group focused">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="input-image" name="tb_jawaban_gambar">
                                                    <label class="custom-file-label" id="view-text-image"><?=$tb_jawaban_gambar?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <img src="<?=base_url()."assets/img/post/".$tb_jawaban_gambar?>" id="view-image" class="img-fluid img-thumbnail rounded mx-auto d-block" width="300" style="margin-bottom:20px;" alt="">
                                        </div>
                                    </div>

                                    <input type="text" name="id_tb_pengedit" value="<?=$id_tb_pengedit?>" hidden>
                                    <input type="text" name="id_tb_jawaban" value="<?=$id_tb_jawaban?>" hidden>
                                    <input type="text" name="tb_jawaban_judul_old" value="<?=$tb_jawaban_judul?>" hidden>
                                    <input type="text" name="tb_jawaban_isi_old" value="" hidden>
                                    <input type="text" name="tb_jawaban_gambar_old" value="<?=$tb_jawaban_gambar?>" hidden>

                                    <div class="form-group">
                                        <input type="text" maxlength="150" name="tb_jawaban_judul" class="form-control text-white" placeholder="Judul" value="<?=@$tb_jawaban_judul?>">
                                    </div>
                                    <textarea name="tb_jawaban_isi" class="form-control text-white" id="form-answer" cols="30" rows="10"><?=$tb_jawaban_isi?></textarea>
                                    <button type="submit" class="btn vizew-btn w-100">Publis Jawaban</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end Form Answer Section -->
                    <?php
                        }
                    ?>

                    <!-- Daftar jawaban siap publis -->
                    <div>
                        <div class="section-heading style-2 mt-4">
                            <h4>Daftar Jawaban Siap Publis</h4>
                            <div class="line"></div>
                        </div>

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
                        
                        <!-- data pagination -->
                        <div id="data-published-answer">
                        
                        </div>
                        <!-- end data pagination -->

                        <nav class="mt-50">
                            <ul class="pagination justify-content-center" id="pagination">
                            
                            </ul>
                        </nav>
                        
                    </div>
                    <!-- end Daftar jawaban siap publis -->

                </div>
            </div>

            <!-- right widget -->
            <div class="col-12 col-md-5 col-lg-4 mt-4">
                <div class="sidebar-area">
                    
                    <!-- ***** Single Widget Digital Clock ***** -->
                    <div class="single-widget followers-widget mb-50 clock-container">
                        <p class="text-center clock-item" id="set-clock">00:00:00</p>
                    </div>

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget latest-video-widget mb-50">
                        
                        <!-- Section Heading -->
                        <div class="section-heading style-2 mb-30">
                            <h4>Belum Dipublis</h4>
                            <div class="line"></div>
                        </div>

                        <!-- Pertanyaan belum dijawab -->
                        <div class="single-post-area mb-30" id="question-entered-old">
                            
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Vizew Psot Area End ##### -->

<!-- Custom inline -->
<script type="text/javascript">
    $(document).ready(function(){
        <?php
            if(@$dataReady['data']){
        ?>
        var editor = new Simditor({
            textarea: $('#form-answer')
        });
        <?php
            }
        ?>

        // menyembunyikan tombol insert image di simditor
        $('.toolbar-item-image').hide();

        // membuat preview gambar sebelum diupload
        function viewGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader()
        
            reader.onload = function (e) {
                $('#view-image').attr('src', e.target.result)
            }
        
            reader.readAsDataURL(input.files[0])
        }
        }

        $("#input-image").change(function(){
        viewGambar(this)
        })
        // end

        // membuat preview gambar sebelum diupload

        // $('input[type="file"]').change(function(e){
        //   var fileName = e.target.files[0].name
        //   alert('The file "'+fileName+'"has been selected.')
        //   })
        // })
        $("#input-image").change(function(){
        var fileName = $('#input-image').val().split('\\').pop();
        $('#view-text-image').text(fileName)
        })
        // end

        $('#loading-area').hide();
        // pagination data
        loader(true);
        $.when(paginationData()).done(function(a1){
            loader(false);
        });
        // end pagination data

        // side right data
        questionOld();
        // end side right data

        let data = <?=json_encode($data['data'])?>;
        let dataLength = data.length;

        // pagination
        let rowT =  '<li class="page-item top-page"><a class="page-link top-link" id-page="1" href="#"><i class="fa fa-angle-left"></i></a></li>'; 
        if(data != null && dataLength > 5){
            $('#pagination').append(rowT);
        }

        paginationMidle();

        let rowB =  '<li class="page-item bottom-page"><a class="page-link bottom-link" id-page="2" href="#"><i class="fa fa-angle-right"></i></a></li>';
        if(data != null && dataLength > 5){
            $('#pagination').append(rowB);
        }
        // end pagination

        // click pagination
        $('.active-link').off('click');
        $('.midle-link').click(function(){
            let data = <?=json_encode($data['data'])?>;
            
            let dataLength = data.length;
            let dataMod = dataLength % 5;
            let dataTot = parseInt(dataLength/5);
            let dataPage = dataTot;
            
            if(dataMod > 0){
                dataPage = dataTot+1;
            }

            let page = (this).getAttribute('id-page');

            $('.top-page').removeClass('active');
            $('.top-link').removeClass('active-link');
            $('.midle-page').removeClass('active');
            $('.midle-link').removeClass('active-link');
            $('.bottom-page').removeClass('active');
            $('.bottom-link').removeClass('active-link');
            
            $('#data-published-answer').empty();

            if(page == 1){
                $('.bottom-link').removeAttr('hidden');
                $('.top-link').attr('hidden', 'hidden');
                console.log("atas");
            }else if(page == dataPage){
                $('.top-link').removeAttr('hidden');
                $('.bottom-link').attr('hidden', 'hidden');
                console.log("tengah");
            }else{
                $('.top-link').removeAttr('hidden');
                $('.bottom-link').removeAttr('hidden');
                console.log("bawah");
            }

            $('.top-link').attr('id-page', (parseInt(page)-1));
            $('.bottom-link').attr('id-page', (parseInt(page)+1));

            $(this).addClass('active-link');
            $(this).parent('li').addClass('active');
            $('.midle-link').on('click');
            
            loader(true);
            $.when(paginationData(((parseInt(page)*5)-5))).done(function(a1){
                loader(false);
            });

        });

        $('.top-link').attr('hidden', 'hidden');
        $('.top-link').click(function(){
            let page = (this).getAttribute('id-page');

            $('.top-page').removeClass('active');
            $('.top-link').removeClass('active-link');
            $('.midle-page').removeClass('active');
            $('.midle-link').removeClass('active-link');
            $('.bottom-page').removeClass('active');
            $('.bottom-link').removeClass('active-link');
            
            $('#data-published-answer').empty();

            $('.bottom-link').removeAttr('hidden');
            if(page == 1){
                $('.top-link').attr('hidden', 'hidden');
            }else{
                $('.top-link').removeAttr('hidden');
            }

            $('.top-link').attr('id-page', (parseInt(page)-1));
            $('.bottom-link').attr('id-page', (parseInt(page)+1));

            $('.midle-'+page).addClass('active-link');
            $('.midle-'+page).parent('li').addClass('active');
            $('.midle-link').on('click');

            loader(true);
            $.when(paginationData(((parseInt(page)*5)-5))).done(function(a1){
                loader(false);
            });

        });

        $('.bottom-link').click(function(){
            let data = <?=json_encode($data['data'])?>;
            
            let dataLength = data.length;
            let dataMod = dataLength % 5;
            let dataTot = parseInt(dataLength/5);
            let dataPage = dataTot;
            
            if(dataMod > 0){
                dataPage = dataTot+1;
            }

            let page = (this).getAttribute('id-page');

            $('.top-page').removeClass('active');
            $('.top-link').removeClass('active-link');
            $('.midle-page').removeClass('active');
            $('.midle-link').removeClass('active-link');
            $('.bottom-page').removeClass('active');
            $('.bottom-link').removeClass('active-link');
            
            $('#data-published-answer').empty();

            $('.top-link').removeAttr('hidden');
            if(page == dataPage){
                $('.bottom-link').attr('hidden', 'hidden');
            }else{
                $('.bottom-link').removeAttr('hidden');
            }

            $('.top-link').attr('id-page', (parseInt(page)-1));
            $('.bottom-link').attr('id-page', (parseInt(page)+1));

            $('.midle-'+page).addClass('active-link');
            $('.midle-'+page).parent('li').addClass('active');
            $('.midle-link').on('click');

            loader(true);
            $.when(paginationData(((parseInt(page)*5)-5))).done(function(a1){
                loader(false);
            });

        });
        // end click pagination

        // hapus publis jawaban
        $('.delete-published-answer').click(function(e){
            e.preventDefault();
            let link = $(this).attr('href');
            Swal.fire({
                title: 'Peringatan!',
                text: "Anda tidak bisa mengembalikan data yang sudah terhapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tetap Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    window.location.href = link;
                }
            });
            // alert(link);
        });
        // end hapus publis jawaban
 
    });

    function loader(a = true){
        $('#loading-area').show();
        if(a == false){
            $('#loading-area').hide();
        }
    }

    // pagination Data
    function paginationData(page = 0){

        let data = <?=json_encode($data['data'])?>;
        
        if(data != ''){

            let dataLength = data.length;
            let dataMod = dataLength % 5;
            let dataTot = parseInt(dataLength/5);
            let dataPage = dataTot;
            
            if(dataMod > 0){
                dataPage = dataTot+1;
            }

            if((((page+5)/5) == (dataPage) || dataLength == dataMod) && dataMod != 0){
                for(let i = page; i <= ((page+dataMod)-1); i++){
                                            
                    row =   '<div class="single-post-area mb-30">'+
                            '<div class="row align-items-center">'+
                                '<div class="col-12 col-lg-6">'+
                                    '<div class="post-thumbnail">'+
                                        '<img src="<?=base_url()?>assets/img/post/'+data[i].tb_jawaban_gambar+'" alt="">'+
                                        '<span class="video-duration">'+_dateIND(data[i].tb_pengedit_tgl)+'</span>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-12 col-lg-6">'+
                                    '<div class="post-content mt-0">'+
                                    '<a href="<?=base_url()?>editor/jawaban-terpublis/'+data[i].id_tb_penjawab+'" class="post-cata cata-sm cata-success">Edit</a>'+
                                    '<a href="<?=base_url()?>editor/delete-published-answer/'+data[i].id_tb_pertanyaan+'/'+data[i].id_tb_jawaban+'/'+data[i].tb_jawaban_gambar+'" class="post-cata cata-sm cata-danger ml-2 delete-published-answer">Hapus</a>'+
                                        '<a target="_blank" href="<?=base_url()?>multi/single-post/'+data[i].id_tb_jawaban+'" class="post-title mb-2">'+_splitText(data[i].tb_jawaban_judul, 50)+'</a>'+
                                        '<div class="post-meta d-flex align-items-center mb-2">'+
                                            '<a href="#" class="post-author">Dipublis oleh '+data[i].tb_akun_detail_nama+'</a>'+
                                        '</div>'+
                                        '<p class="mb-2">'+_splitText(data[i].tb_jawaban_isi, 150)+'</p>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                    
                    if(<?=json_encode($id_tb_pengedit)?> == data[i].id_tb_pengedit){
                        if(dataLength == 1){
                            row =   '<div class="single-post-area mb-30">'+
                                        '<div class="row align-items-center">'+
                                            '<div class="col-12 col-lg-12">'+
                                                '<h5 class="text-center text-default">Tidak ada jawaban yang sudah di publis.</h5>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                            $("#data-published-answer").append(row);
                        }
                    }else{
                        $("#data-published-answer").append(row);
                    }

                } 
            }else{
                for(let i = page; i <= (page+4); i++){
                          
                    row =   '<div class="single-post-area mb-30">'+
                            '<div class="row align-items-center">'+
                                '<div class="col-12 col-lg-6">'+
                                    '<div class="post-thumbnail">'+
                                        '<img src="<?=base_url()?>assets/img/post/'+data[i].tb_jawaban_gambar+'" alt="">'+
                                        '<span class="video-duration">'+_dateIND(data[i].tb_pengedit_tgl)+'</span>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-12 col-lg-6">'+
                                    '<div class="post-content mt-0">'+
                                        '<a href="<?=base_url()?>editor/jawaban-terpublis/'+data[i].id_tb_penjawab+'" class="post-cata cata-sm cata-success">Edit</a>'+
                                        '<a href="<?=base_url()?>editor/delete-published-answer/'+data[i].id_tb_pertanyaan+'/'+data[i].id_tb_jawaban+'/'+data[i].tb_jawaban_gambar+'" class="post-cata cata-sm cata-danger ml-2 delete-published-answer">Hapus</a>'+
                                        '<a target="_blank" href="<?=base_url()?>multi/single-post/'+data[i].id_tb_jawaban+'" class="post-title mb-2">'+_splitText(data[i].tb_jawaban_judul, 50)+'</a>'+
                                        '<div class="post-meta d-flex align-items-center mb-2">'+
                                            '<a href="#" class="post-author">Dipublis oleh '+data[i].tb_akun_detail_nama+'</a>'+
                                        '</div>'+
                                        '<p class="mb-2">'+_splitText(data[i].tb_jawaban_isi, 150)+'</p>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';

                    if(<?=json_encode($id_tb_pengedit)?> == data[i].id_tb_pengedit){
                        if(dataLength == 1){
                            row =   '<div class="single-post-area mb-30">'+
                                        '<div class="row align-items-center">'+
                                            '<div class="col-12 col-lg-12">'+
                                                '<h5 class="text-center text-default">Tidak ada jawaban yang sudah di publis.</h5>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                            $("#data-published-answer").append(row);
                        }
                    }else{
                        $("#data-published-answer").append(row);
                    }
                }
            }
        }else{
            let row = '<div class="single-post-area mb-30">'+
                            '<div class="row align-items-center">'+
                                '<div class="col-12 col-lg-12">'+
                                    '<h5 class="text-center text-default">Tidak ada jawaban yang sudah di publis.</h5>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            $("#data-published-answer").append(row);
        }

    }
    // end pagination data

    // pagination midle
    function paginationMidle(){
        $('.midle-page').remove();
        let data = <?=json_encode($data['data'])?>;

        if(data != null){
            let dataLength = data.length;
            let dataMod = dataLength % 5;
            let dataTot = parseInt(dataLength/5);
            let dataPage = dataTot;
            
            if(dataMod > 0){
                dataPage = dataTot+1;
            }

            for(let i = 0; i <= dataPage-1; i++){

                let rowM =  '<li class="page-item midle-page"><a class="page-link midle-link midle-'+(i+1)+'" id-page="'+(i+1)+'" href="#">'+(i+1)+'</a></li>';
                if(i == 0){
                    rowM =  '<li class="page-item midle-page active"><a class="page-link active-link midle-link midle-'+(i+1)+'" id-page="'+(i+1)+'" href="#">'+(i+1)+'</a></li>';
                }

                if(dataLength > 5){
                    $('#pagination').append(rowM);
                }

            }

            $('.top-page').addClass('active');
            $('.top-link').addClass('active-link');
        }

    }
    // end pagination midle

    function questionOld(){

        let data = <?=json_encode($dataOld['data'])?>;

        if(data != null){
            let dataLength = data.length;
            let dataMod = dataLength % 3;
            let dataTot = parseInt(dataLength/3);
            let dataPage = dataTot;
            
            if(dataMod > 0){
                dataPage = dataTot+1;
            }

            if(dataLength == dataMod){
                for(let i = 0; i <= (dataMod-1); i++){

                    let row =   '<div class="row align-items-center mb-2">'+
                                    '<div class="col-12 col-lg-12">'+
                                        '<a href="<?=base_url()?>editor/jawaban-siap-publis/'+data[i].id_tb_penjawab+'" class="post-cata cata-sm cata-success">Publis</a>'+
                                        '<a href="#" class="btn-modal-question-detail" id_tb_pertanyaan="'+data[i].id_tb_pertanyaan+'">'+
                                            '<div class="card pl-2 bg-darkself">'+
                                                '<span class="question-date">'+_dateIND(data[i].tb_pertanyaan_tgl)+'</span>'+
                                                '<p class="mb-2 text-white">'+_splitText(data[i].tb_pertanyaan_isi, 80)+'</p>'+
                                            '</div>'+
                                        '</a>'+
                                    '</div>'+
                                '</div>';
                    $('#question-entered-old').append(row);

                }

            }else{
                for(let i = (dataPage-3); i <= (dataPage-1); i++){

                    let row =   '<div class="row align-items-center mb-2">'+
                                    '<div class="col-12 col-lg-12">'+
                                        '<a href="<?=base_url()?>editor/jawaban-siap-publis/'+data[i].id_tb_penjawab+'" class="post-cata cata-sm cata-success">Publis</a>'+
                                        '<a href="#" class="btn-modal-question-detail" id_tb_pertanyaan="'+data[i].id_tb_pertanyaan+'">'+
                                            '<div class="card pl-2 bg-darkself">'+
                                                '<span class="question-date">'+_dateIND(data[i].tb_pertanyaan_tgl)+'</span>'+
                                                '<p class="mb-2 text-white">'+_splitText(data[i].tb_pertanyaan_isi, 80)+'</p>'+
                                            '</div>'+
                                        '</a>'+
                                    '</div>'+
                                '</div>';
                    $('#question-entered-old').append(row);
                    
                }
            }
        }

    }

</script>