<?php
    $CI =& get_instance();
    $RMY = $CI->LibraryRMYModel;
    $id_tb_pertanyaan = $dataMyQuestion['data'][0]['id_tb_pertanyaan'];
    // echo $dataMyQuestion['data'][0]['id_tb_pertanyaan'];
    // die;
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
                    
                    <div id="alert-message-hidden">
                        <div class="alert" id="alert-login" role="alert">
                            <strong>dsdsds</strong>
                        </div>     
                    </div>
                    
                    <!-- Form Question -->
                    <div class="single-post-area mb-30" id="form-question-hidden">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <form action="<?=base_url()?>user/post-my-question" method="POST" name="form-question" onsubmit="return validateForm()">
                                    <!-- <p id="count-question-caracter">250</p> -->
                                    <textarea name="tb_pertanyaan_isi" class="form-control text-white" id="pertanyaan" cols="30" rows="10" maxlength="1500"></textarea>
                                    <button type="submit" class="btn vizew-btn w-100">Kirim Pertanyaan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- endForm Question -->

                    <!-- Pertanyaan baru dikirim -->
                    <div class="single-post-area mb-30" id="my-question-hidden">
                        
                    </div>

                    <!-- Daftar rangking saran jawaban -->
                    <div id="suggested-answer-hidden">
                        <div class="section-heading style-1 mt-4">
                            <h4 id="saran">Saran Jawaban</h4>
                            <div class="line"></div>
                        </div>
                        
                        <div id="btn-not-yet" class="text-center">
                            
                        </div>

                        <div id="suggested-answer-data">
                        
                        </div>

                    </div>
                    <!-- end Daftar rangking saran jawaban -->

                    
                    <!-- Daftar pertanyaan sudah dijawab -->
                    <div class="mt-50">
                        <div class="section-heading style-2 mt-4">
                            <h4>Pertanyaan Sudah Dijawab</h4>
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
                        <div id="data-my-question-answered">
                        
                        </div>
                        <!-- end data pagination -->

                        <nav class="mt-50">
                            <ul class="pagination justify-content-center" id="pagination">
                            
                            </ul>
                        </nav>

                    </div>
                    <!-- end Daftar jawaban saya -->

                </div>
            </div>

            <!-- right widget -->
            <div class="col-12 col-md-5 col-lg-4 mt-4">
                <div class="sidebar-area">

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget followers-widget mb-50 clock-container">
                        <p class="text-center clock-item" id="set-clock">00:00:00</p>                        
                    </div>

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget latest-video-widget mb-50">
                        
                        <!-- Section Heading -->
                        <div class="section-heading style-2 mb-30">
                            <h4>Jawaban Yang Mirip</h4>
                            <div class="line"></div>
                        </div>

                        <!-- Pertanyaan Yang Sama -->
                        <div class="single-post-area mb-30" id="answer-similarity">
                            
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Vizew Psot Area End ##### -->

<script type="text/javascript">    
    $(document).ready(function(){
        // hidden element
        $('#alert-message-hidden').hide();
        $('#form-question-hidden').hide();
        $('#my-question-hidden').hide();
        $('#suggested-answer-hidden').hide();
        $('#btn-not-yet').hide();
        // end hidden element

        alertMessage = '<?=@$result['message']?>';
        if(alertMessage != ''){
            $('#alert-login').show().addClass('alert-danger');
            setTimeout(function(){$('#lert-message-hidden').fadeOut('slow');}, 2500);
        }

        <?php
            if($dataMyQuestion['data'] == null){
        ?>
        $('#form-question-hidden').show();
        // var editor = new Simditor({
        //     textarea: $('#form-answer')
        // });
        <?php
            }else{
        ?>
        $('#my-question-hidden').show();
        $('#suggested-answer-hidden').show();
        $('#btn-not-yet').show();
        myQuestionData();
        suggestedAnswer();
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
        answeredNotYetPublished();
        // end side right data

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
            
            $('#data-my-question-answered').empty();

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
            
            $('#data-my-question-answered').empty();

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
            
            $('#data-my-question-answered').empty();

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

        // hapus pertanyaan
        $('.delete-my-question').click(function(e){
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
        // end hapus pertanyaan        

    });

    function myQuestionData(){
        let dataMyQuestion = <?=json_encode($dataMyQuestion['data'])?>;
        let row =   '<div class="row align-items-center">'+            
                        '<div class="col-12 col-lg-12">'+
                            '<a href="<?=base_url()?>user/delete-my-question/'+dataMyQuestion[0].id_tb_pertanyaan+'" class="post-cata cata-sm cata-danger ml-2 delete-my-question">Hapus</a>'+
                            '<blockquote class="vizew-blockquote mb-15">'+
                                '<h5 class="blockquote-text">"'+dataMyQuestion[0].tb_pertanyaan_isi+'”</h5>'+
                                '<h6 class="text-red">'+_dateIND(dataMyQuestion[0].tb_pertanyaan_tgl)+'</h6>'+
                            '</blockquote>'+
                        '</div>'+
                    '</div>';
        $('#my-question-hidden').append(row);
    }

    function suggestedAnswer(){
        let dataMyQuestion = <?=json_encode($dataMyQuestion['data'])?>;
        let dataSuggest = <?=json_encode($dataSuggest)?>;
        let dataSuggestLength = null;
        if(dataSuggest != null){
            dataSuggestLength = dataSuggest.length;
            // alert('sas')
        }
        let row;
        let id_tb_pertanyaan = '<?=$id_tb_pertanyaan?>';

        console.log(dataSuggest);

        if(dataMyQuestion[0].tb_pertanyaan_level == 0){
            if(dataSuggest != '' || dataSuggest != null){

                for(let i = dataSuggestLength-1; i >= 0 ; i--){

                    row =   '<div class="single-post-area mb-30">'+
                                '<div class="row align-items-center">'+
                                    '<div class="col-12 col-lg-6">'+
                                        '<div class="post-thumbnail">'+
                                            '<img src="<?=base_url()?>assets/img/post/'+dataSuggest[i].tb_jawaban_gambar+'" alt="">'+
                                            '<span class="video-duration">'+_dateIND(dataSuggest[i].tb_penjawab_tgl)+'</span>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-12 col-lg-6">'+
                                        '<div class="post-content mt-0">'+
                                        '<a href="#" class="post-cata cata-sm cata-success">Kecocokan '+(dataSuggest[i]['similarity']*100).toFixed(2)+'%</a>'+
                                            '<a target="_blank" href="<?=base_url()?>multi/single-post/'+dataSuggest[i].id_tb_jawaban+'/'+id_tb_pertanyaan+'" class="post-title mb-2">'+_splitText(dataSuggest[i].tb_jawaban_judul, 50)+'</a>'+
                                            '<div class="post-meta d-flex align-items-center mb-2">'+
                                                '<a href="#" class="post-author">Oleh '+dataSuggest[i].tb_akun_detail_nama+'</a>'+
                                            '</div>'+
                                            '<p class="mb-2">'+_splitText(dataSuggest[i].tb_jawaban_isi, 150)+'</p>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                            
                    $('#suggested-answer-data').append(row);

                    if(i == (dataSuggestLength - 3)){
                        break;
                    }
                }

                let btn = '<a href="<?=base_url()?>user/belum-terjawab/'+id_tb_pertanyaan+'" class="post-cata cata-sm cata-danger">Tidak Ada Jawaban Yang Cocok</a>';
                $('#btn-not-yet').append(btn);
            }else{
                row =   '<div class="single-post-area mb-30">'+
                            '<div class="row align-items-center">'+
                                '<div class="col-12 col-lg-12">'+
                                    '<h5 class="text-center text-default">Tidak ada pertanyaan yang cocok.</h5>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                $('#suggested-answer-data').append(row);
            }

        }else{
            row =   '<div class="single-post-area mb-30">'+
                            '<div class="row align-items-center">'+
                                '<div class="col-12 col-lg-12">'+
                                    '<h5 class="text-center text-default">Menunggu jawaban.</h5>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            $('#suggested-answer-data').append(row);
        }
        

    }

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
                                            '<a target="_blank" href="<?=base_url()?>multi/single-post/'+data[i].id_tb_jawaban+'" class="post-title mb-2">'+_splitText(data[i].tb_pertanyaan_isi, 50)+'</a>'+
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
                            
                    }

                    $('#data-my-question-answered').append(row);
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

                    $('#data-my-question-answered').append(row);

                }
            }
        }else{
            let row = '<div class="single-post-area mb-30">'+
                            '<div class="row align-items-center">'+
                                '<div class="col-12 col-lg-12">'+
                                    '<h5 class="text-center text-default">Belum ada pertanyaan yang dijawab.</h5>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            $('#data-my-question-answered').append(row);
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

    function answeredNotYetPublished(){

        let data = <?=json_encode($dataSimilarity['data'])?>;
        console.log(data);

        if(data != null){
            let dataLength = data.length;
            let dataMod = dataLength % 3;
            let dataTot = parseInt(dataLength/3);
            let dataPage = dataTot;
            
            if(dataMod > 0){
                dataPage = dataTot+1;
            }

            if(dataLength == dataMod){
                let count = 0;
                for(let i = 0; i <= (dataMod-1); i++){

                    let row =   '<div class="row align-items-center mb-2">'+
                                    '<div class="col-12 col-lg-12">'+
                                        '<a target="_blank" href="<?=base_url()?>multi/single-post/'+data[i].id_tb_jawaban+'">'+
                                            '<div class="card pl-2 bg-darkself">'+
                                                '<span class="question-date">'+_dateIND(data[i].tb_pertanyaan_tgl)+'</span>'+
                                                '<p class="mb-2 text-white">'+_splitText(data[i].tb_pertanyaan_isi, 80)+'</p>'+
                                            '</div>'+
                                        '</a>'+
                                    '</div>'+
                                '</div>';
                    
                    if(data[i].tb_pertanyaan_level == '4'){
                        count += 1;
                        $('#answer-similarity').append(row);
                    }

                    if(count == 3){
                        break;
                    }

                }

            }else{
                let count = 0;
                for(let i = 0; i <= dataLength-1; i++){

                    let row =   '<div class="row align-items-center mb-2">'+
                                    '<div class="col-12 col-lg-12">'+
                                        '<a target="_blank" href="<?=base_url()?>multi/single-post/'+data[i].id_tb_jawaban+'">'+
                                            '<div class="card pl-2 bg-darkself">'+
                                                '<span class="question-date">'+_dateIND(data[i].tb_pertanyaan_tgl)+'</span>'+
                                                '<p class="mb-2 text-white">'+_splitText(data[i].tb_pertanyaan_isi, 80)+'</p>'+
                                            '</div>'+
                                        '</a>'+
                                    '</div>'+
                                '</div>';
                    
                    if(data[i].tb_pertanyaan_level == '4'){
                        count += 1;
                        $('#answer-similarity').append(row);
                    }

                    if(count == 3){
                        break;
                    }
                    
                }
            }
        }

    }

    // form validation
    function validateForm() {     
        let pertanyaan = $.trim(document.forms["form-question"]["tb_pertanyaan_isi"].value);
       
        if (pertanyaan == '' || pertanyaan == null) {
            document.forms["form-question"]["tb_pertanyaan_isi"].focus();
            $('#pertanyaan').addClass('border-red');
            return false;
        }
    }

</script>