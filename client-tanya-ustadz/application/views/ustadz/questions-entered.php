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
                        <h4>Pertanyaan Belum Dijawab</h4>
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

                    <!-- Pertanyaan baru dikirim -->
                    <div id="question-entered-card">

                    </div>
                    
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
                            <h4>Belum Dijawab Juga</h4>
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

<script type="text/javascript">

    $(document).ready(function(){

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

        let data = <?=json_encode($data['data'])?>;

        // pagination
        let rowT =  '<li class="page-item top-page"><a class="page-link top-link" id-page="1" href="#"><i class="fa fa-angle-left"></i></a></li>'; 
        if(data != null && data > 5){
            $('#pagination').append(rowT);
        }

        paginationMidle();
        
        let rowB =  '<li class="page-item bottom-page"><a class="page-link bottom-link" id-page="2" href="#"><i class="fa fa-angle-right"></i></a></li>';
        if(data != null && data > 5){
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
            
            $('#question-entered-card').empty();

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
            
            $('#question-entered-card').empty();

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
            
            $('#question-entered-card').empty();

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

                    let row =   '<div class="single-post-area mb-30">'+
                                    '<div class="row align-items-center">'+
                                        
                                        '<div class="col-12 col-lg-12 bg-darkself shadow">'+
                                            '<a href="#" class="btn-modal-question-detail" id_tb_pertanyaan="'+data[i].id_tb_pertanyaan+'">'+
                                                '<blockquote class="vizew-blockquote pb-1 pt-2 mb-1 mbg-danger">'+
                                                '<p>'+_dateIND(data[i].tb_pertanyaan_tgl)+'</p>'+
                                                    '<h5 class="blockquote-text">”'+_splitText(data[i].tb_pertanyaan_isi, 150)+'”</h5>'+                                    
                                                '</blockquote>'+
                                            '</a>'+
                                            '<div class="row">'+
                                                '<div class="container mb-3 pt-0 pb-0">'+
                                                    '<a href="<?=base_url()?>ustadz/jawaban-saya/'+data[i].id_tb_pertanyaan+'" class="post-cata cata-sm cata-success mb-0 right">Jawab</a>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+

                                    '</div>'+
                                '</div>';

                    $("#question-entered-card").append(row);
                } 
            }else{
                for(let i = page; i <= (page+4); i++){

                    let row =   '<div class="single-post-area mb-30">'+
                                    '<div class="row align-items-center">'+
                                        
                                        '<div class="col-12 col-lg-12 bg-darkself shadow">'+
                                            '<a href="#" class="btn-modal-question-detail" id_tb_pertanyaan="'+data[i].id_tb_pertanyaan+'">'+
                                                '<blockquote class="vizew-blockquote pb-1 pt-2 mb-1 mbg-danger">'+
                                                '<p>'+_dateIND(data[i].tb_pertanyaan_tgl)+'</p>'+
                                                    '<h5 class="blockquote-text">”'+_splitText(data[i].tb_pertanyaan_isi, 150)+'”</h5>'+                                    
                                                '</blockquote>'+
                                            '</a>'+
                                            '<div class="row">'+
                                                '<div class="container mb-3 pt-0 pb-0">'+
                                                    '<a href="<?=base_url()?>ustadz/jawaban-saya/'+data[i].id_tb_pertanyaan+'" class="post-cata cata-sm cata-success mb-0 right">Jawab</a>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+

                                    '</div>'+
                                '</div>';

                    $("#question-entered-card").append(row);
                }
            }
        }else{
            let row = '<div class="single-post-area mb-30">'+
                            '<div class="row align-items-center">'+
                                '<div class="col-12 col-lg-12">'+
                                    '<h5 class="text-center text-default">Belum ada pertanyaan masuk</h5>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            $("#question-entered-card").append(row);
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

        let data = <?=json_encode($data['data'])?>;
        
        if(data != null){
            let dataLength = data.length;
            let dataMod = dataLength % 3;
            let dataTot = parseInt(dataLength/3);
            let dataPage = dataTot;
            
            if(dataMod > 0){
                dataPage = dataTot+1;
            }

            if(dataLength == dataMod && dataMod != 0){
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
                for(let i = dataPage; i <= 0; i++){

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

                    if(i == 3){
                        break;
                    }
                    
                }
            }
        }

    }

</script>