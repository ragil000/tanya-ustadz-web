<!-- ##### Vizew Post Area Start ##### -->
<section class="vizew-post-area mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-8">
                <div class="all-posts-area">  

                    <!-- Section Heading -->
                    <div class="section-heading style-2 mt-4">
                        <h4>Hasil Pencarian</h4>
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
                    <div id="data-search">
                    
                    </div>
                    <!-- end data pagination -->

                    <nav class="mt-50">
                        <ul class="pagination justify-content-center" id="pagination">
                        
                        </ul>
                    </nav>

                </div>
            </div>

            <div class="col-12 col-md-5 col-lg-4">
                
                <div class="sidebar-area">

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget followers-widget mb-50 clock-container">
                        <p class="text-center clock-item" id="set-clock">00:00:00</p>                        
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

        $('#loading-area').hide();
        // pagination data
        loader(true);
        $.when(paginationData()).done(function(a1){
            loader(false);
        });
        // end pagination data

        let data = <?=json_encode($dataSearch['data'])?>;
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
            let data = <?=json_encode($dataSearch['data'])?>;
            
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
            
            $('#data-search').empty();

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
            
            $('#data-search').empty();

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
            let data = <?=json_encode($dataSearch['data'])?>;
            
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
            
            $('#data-search').empty();

            $('.top-link').removeAttr('hidden');

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
 
    });

    function loader(a = true){
        $('#loading-area').show();
        if(a == false){
            $('#loading-area').hide();
        }
    }

    // pagination Data
    function paginationData(page = 0){

        let data = <?=json_encode($dataSearch['data'])?>;

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
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                    
                    $("#data-search").append(row);

                } 
            }else{
                for(let i = page; i <= (page+4); i++){
                          
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
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';

                    $("#data-search").append(row);
                }
            }
        }else{
            let row = '<div class="single-post-area mb-30">'+
                            '<div class="row align-items-center">'+
                                '<div class="col-12 col-lg-12">'+
                                    '<h5 class="text-center text-default">Tidak ada tanya jawab yang terpublis.</h5>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            $("#data-search").append(row);
        }

    }
    // end pagination data

    
    // pagination midle
    function paginationMidle(){
        $('.midle-page').remove();
        let data = <?=json_encode($dataSearch['data'])?>;

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

</script>