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
                        if(@$dataQuestion['data']){
                    ?>
                    
                    <!-- Section Answer -->
                    <div class="section-heading style-2 mt-4">
                        <h4>Jawab Pertanyaan</h4>
                        <div class="line"></div>
                    </div>
                    
                    <?php
                        $id_tb_pertanyaan = '';
                        foreach($dataQuestion['data'] as $dataQuestionV){
                            $id_tb_pertanyaan = $dataQuestionV['id_tb_pertanyaan'];
                    ?>
                    <!-- Pertanyaan yang dijawab -->
                    <div class="single-post-area mb-30">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <blockquote class="vizew-blockquote mb-15">
                                    <h5 class="blockquote-text">"<?=$dataQuestionV['tb_pertanyaan_isi']?>"</h5>
                                    <h6 class="text-red"><?=$RMY->_dateIND($dataQuestionV['tb_pertanyaan_tgl'])?></h6>
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
                                
                                <?php
                                    if(@$dataAnswer['data']){  
                                ?>
                                <form action="<?=base_url()?>ustadz/put-my-answer" method="POST" name="form-answer-top" onsubmit="return validateForm()">
                                <?php
                                    }else{
                                ?>
                                <form action="<?=base_url()?>ustadz/post-my-answer" method="POST" name="form-answer-top" onsubmit="return validateForm()">
                                <?php
                                    }
                                ?>
                                    <input type="text" name="id_tb_pertanyaan" value="<?=$id_tb_pertanyaan?>" hidden>
                                    
                                    <?php
                                        $tb_jawaban_isi = null;
                                        if(@$dataAnswer['data']){
                                            foreach($dataAnswer['data'] as $dataAnswerV){
                                                $tb_jawaban_isi = $dataAnswerV['tb_jawaban_isi'];
                                    ?>
                                    <input type="text" name="id_tb_jawaban" value="<?=$dataAnswerV['id_tb_jawaban']?>" hidden>
                                    <input type="text" name="tb_jawaban_isi_old" value="" hidden>
                                    <?php
                                            }
                                        }
                                    ?>

                                    <textarea name="tb_jawaban_isi" class="form-control text-white" id="form-answer" cols="30" rows="10"><?=$tb_jawaban_isi?></textarea>
                                    <button type="submit" class="btn vizew-btn w-100">Kirim Jawaban</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end Form Answer Section -->
                    <?php
                        }
                    ?>

                    <!-- Daftar jawaban saya -->
                    <div>
                        <div class="section-heading style-2 mt-4">
                            <h4>Daftar Jawaban Saya</h4>
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
                        <div id="data-my-answer">
                        
                        </div>
                        <!-- end data pagination -->

                        <nav class="mt-50">
                            <ul class="pagination justify-content-center" id="pagination">
                            
                            </ul>
                        </nav>

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
                                        <p class="text-dark" id="question-detail">Modal body text goes here.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="" id="btn-question-detail" class="btn btn-success btn-sm pl-4 pr-4">Jawab</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal lihat pertanyaan -->

                    </div>
                    <!-- end Daftar jawaban saya -->
                    
                    
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
                            <h4>Belum Dijawab</h4>
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
            if(@$dataQuestion){
        ?>
        var editor = new Simditor({
            textarea: $('#form-answer')
        });
        <?php
            }
        ?>

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

        // click detail question
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
            
        });
        // end click detail question

        let data = <?=json_encode($dataAll['data'])?>;
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
            let data = <?=json_encode($dataAll['data'])?>;
            
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
            
            $('#data-my-answer').empty();

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
            
            // click detail question
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
                
            });
            // end click detail question

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
            
            $('#data-my-answer').empty();

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
            
            // click detail question
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
                
            });
            // end click detail question

        });

        $('.bottom-link').click(function(){
            let data = <?=json_encode($dataAll['data'])?>;
            
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
            
            $('#data-my-answer').empty();

            $('.top-link').removeAttr('hidden');

            if(page == dataPage){
                $('.bottom-link').attr('hidden', 'hidden');
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
            
            // click detail question
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
                
            });
            // end click detail question

        });
        // end click pagination

        // hapus jawaban
        $('.delete-my-answer').click(function(e){
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
        // end hapus jawaban        

    });

    function loader(a = true){
        $('#loading-area').show();
        if(a == false){
            $('#loading-area').hide();
        }
    }

    // pagination Data
    function paginationData(page = 0){

        let data = <?=json_encode($dataAll['data'])?>;

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
                    
                    let row = null;
                    let status = 'Belum dipublis';
                    if(data[i].tb_pertanyaan_level == 3){
                        status = 'Sudah dipublis';
                        
                        row =   '<div class="single-post-area mb-30">'+
                                '<div class="row align-items-center">'+
                                    '<div class="col-12 col-lg-6">'+
                                        '<div class="post-thumbnail">'+
                                            '<img src="<?=base_url()?>assets/img/post/'+data[i].tb_jawaban_gambar+'" alt="">'+
                                            '<span class="video-duration">'+_dateIND(data[i].tb_penjawab_tgl)+'</span>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-12 col-lg-6">'+
                                        '<div class="post-content mt-0">'+
                                            '<a target="_blank" href="<?=base_url()?>multi/single-post/'+data[i].id_tb_jawaban+'" class="post-title mb-2">'+_splitText(data[i].tb_jawaban_judul, 50)+'</a>'+
                                            '<div class="post-meta d-flex align-items-center mb-2">'+
                                                '<a href="#" class="post-author">Oleh '+data[i].tb_akun_detail_nama+'</a>'+
                                            '</div>'+
                                            '<p class="mb-2">'+_splitText(data[i].tb_jawaban_isi, 150)+'</p>'+
                                            '<div class="post-meta d-flex">'+
                                                '<p class="text-success"><i class="fa fa-exchange" aria-hidden="true"></i> '+status+'</p>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';

                    }else{

                        row =   '<div class="single-post-area mb-30">'+
                                '<div class="row align-items-center">'+
                                    '<div class="col-12 col-lg-6">'+
                                        '<div class="post-thumbnail">'+
                                            '<img src="<?=base_url()?>assets/img/post/'+data[i].tb_jawaban_gambar+'" alt="">'+
                                            '<span class="video-duration">'+_dateIND(data[i].tb_penjawab_tgl)+'</span>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-12 col-lg-6">'+
                                        '<div class="post-content mt-0">'+
                                            '<a href="<?=base_url()?>ustadz/jawaban-saya/'+data[i].id_tb_pertanyaan+'/'+data[i].id_tb_jawaban+'" class="post-cata cata-sm cata-success">Edit</a>'+
                                            '<a href="<?=base_url()?>ustadz/delete-my-answer/'+data[i].id_tb_pertanyaan+'/'+data[i].id_tb_jawaban+'" class="post-cata cata-sm cata-danger ml-2 delete-my-answer">Hapus</a>'+
                                            '<a target="_blank" href="<?=base_url()?>multi/single-post/'+data[i].id_tb_jawaban+'" class="post-title mb-2">'+_splitText(data[i].tb_pertanyaan_isi, 50)+'</a>'+
                                            '<div class="post-meta d-flex align-items-center mb-2">'+
                                                '<a href="#" class="post-author">Oleh '+data[i].tb_akun_detail_nama+'</a>'+
                                            '</div>'+
                                            '<p class="mb-2">'+_splitText(data[i].tb_jawaban_isi, 150)+'</p>'+
                                            '<div class="post-meta d-flex">'+
                                                '<p class="text-red"><i class="fa fa-exchange" aria-hidden="true"></i> '+status+'</p>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                            
                    }

                    $("#data-my-answer").append(row);
                } 
            }else{
                for(let i = page; i <= (page+4); i++){
                    
                    let row = null;
                    let status = 'Belum dipublis';
                    if(data[i].tb_pertanyaan_level == 3){
                        status = 'Sudah dipublis';
                        
                        row =   '<div class="single-post-area mb-30">'+
                                '<div class="row align-items-center">'+
                                    '<div class="col-12 col-lg-6">'+
                                        '<div class="post-thumbnail">'+
                                            '<img src="<?=base_url()?>assets/img/post/'+data[i].tb_jawaban_gambar+'" alt="">'+
                                            '<span class="video-duration">'+_dateIND(data[i].tb_penjawab_tgl)+'</span>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-12 col-lg-6">'+
                                        '<div class="post-content mt-0">'+
                                            '<a target="_blank" href="<?=base_url()?>multi/single-post/'+data[i].id_tb_jawaban+'" class="post-title mb-2">'+_splitText(data[i].tb_jawaban_judul, 50)+'</a>'+
                                            '<div class="post-meta d-flex align-items-center mb-2">'+
                                                '<a href="#" class="post-author">Oleh '+data[i].tb_akun_detail_nama+'</a>'+
                                            '</div>'+
                                            '<p class="mb-2">'+_splitText(data[i].tb_jawaban_isi, 150)+'</p>'+
                                            '<div class="post-meta d-flex">'+
                                                '<p class="text-red"><i class="fa fa-exchange" aria-hidden="true"></i> '+status+'</p>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';

                    }else{

                        row =   '<div class="single-post-area mb-30">'+
                                '<div class="row align-items-center">'+
                                    '<div class="col-12 col-lg-6">'+
                                        '<div class="post-thumbnail">'+
                                            '<img src="<?=base_url()?>assets/img/post/'+data[i].tb_jawaban_gambar+'" alt="">'+
                                            '<span class="video-duration">'+_dateIND(data[i].tb_penjawab_tgl)+'</span>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-12 col-lg-6">'+
                                        '<div class="post-content mt-0">'+
                                            '<a href="<?=base_url()?>ustadz/jawaban-saya/'+data[i].id_tb_pertanyaan+'/'+data[i].id_tb_jawaban+'" class="post-cata cata-sm cata-success">Edit</a>'+
                                            '<a href="<?=base_url()?>ustadz/delete-my-answer/'+data[i].id_tb_pertanyaan+'/'+data[i].id_tb_jawaban+'" class="post-cata cata-sm cata-danger ml-2 delete-my-answer">Hapus</a>'+
                                            '<a target="_blank" href="<?=base_url()?>multi/single-post/'+data[i].id_tb_jawaban+'" class="post-title mb-2">'+_splitText(data[i].tb_pertanyaan_isi, 50)+'</a>'+
                                            '<div class="post-meta d-flex align-items-center mb-2">'+
                                                '<a href="#" class="post-author">Oleh '+data[i].tb_akun_detail_nama+'</a>'+
                                            '</div>'+
                                            '<p class="mb-2">'+_splitText(data[i].tb_jawaban_isi, 150)+'</p>'+
                                            '<div class="post-meta d-flex">'+
                                                '<p class="text-red"><i class="fa fa-exchange" aria-hidden="true"></i> '+status+'</p>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                            
                    }

                    $("#data-my-answer").append(row);

                }
            }
        }else{
            let row = '<div class="single-post-area mb-30">'+
                            '<div class="row align-items-center">'+
                                '<div class="col-12 col-lg-12">'+
                                    '<h5 class="text-center text-default">Anda belum pernah menjawab pertanyaan</h5>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            $("#data-my-answer").append(row);
        }

    }
    // end pagination data

    // pagination midle
    function paginationMidle(){
        $('.midle-page').remove();
        let data = <?=json_encode($dataAll['data'])?>;

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

        let data = <?=json_encode($dataQuestionEntered['data'])?>;

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

    // form validation
    function validateForm() {     
        let jawaban = $.trim(document.forms["form-answer-top"]["tb_jawaban_isi"].value);
       
        if (jawaban == '' || jawaban == null) {
            document.forms["form-answer-top"]["tb_jawaban_isi"].focus();
            $('#form-answer').addClass('border-red');
            return false;
        }
    }
</script>