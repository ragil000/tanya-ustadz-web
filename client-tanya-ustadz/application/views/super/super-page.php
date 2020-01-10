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
                        <button id="btn-tambah-akun" class="btn vizew-btn w-100 mb-4">Tambah Akun</button>
                        <h4>Semua Data Akun</h4>
                        <div class="line"></div>
                    </div>
                    
                    <!-- Form akun -->
                    <div class="single-post-area mb-30" id="form-account-hidden">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <form action="<?=base_url()?>super/postAccount" name="form-register" method="post" onsubmit="return validateForm()">
                                    <div class="form-group">
                                        <p id="same-username" class="pt-0 pb-0 mt-0 mb-0">Nama user sudah ada.</p>
                                        <input type="text" id="username" name="tb_akun_username" class="form-control text-white" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password-one" name="tb_akun_password" class="form-control text-white" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password-two" name="tb_akun_password_cek" class="form-control text-white" placeholder="Tulis Ulang Password">
                                    </div>
                                    <div class="form-group">
                                        <p id="level-ket" class="pt-0 pb-0 mt-0 mb-0">Super Admin = 0, Editor = 1, Ustadz = 2, User = 3.</p>
                                        <input type="text" id="level" name="tb_akun_level" class="form-control text-white" placeholder="Level 0/1/2/3">
                                    </div>
                                    <button type="submit" class="btn vizew-btn w-100 mt-30">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- endForm akun -->

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

                    <!-- Semua data akun -->
                    <div id="account-data">

                    </div>
                    
                    <nav class="mt-50">
                        <ul class="pagination justify-content-center" id="pagination">
                           
                        </ul>
                    </nav>
                  
                    <!-- modal lihat pertanyaan -->
                    <!-- <div class="modal fade" id="modal-question-detail" tabindex="-1" role="dialog">
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
                    </div> -->
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

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Vizew Psot Area End ##### -->

<script type="text/javascript">

    $(document).ready(function(){

        $('#form-account-hidden').hide();
        $('#same-username').hide();
        $('#level-ket').hide();

        $('#btn-tambah-akun').click(function(){
            $('#form-account-hidden').show();
            
        });

        // pagination data
        loader(true);
        $.when(paginationData()).done(function(a1){
            loader(false);
        });
        // end pagination data

        // hapus akun
        $('.delete-akun').click(function(e){
            e.preventDefault();
            let link = $(this).attr('href');
            Swal.fire({
                title: 'Peringatan!',
                text: "Anda akan menonaktifkan akun!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Nonaktifkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    window.location.href = link;
                }
            });
            // alert(link);
        });
        // end hapus akun

        // click detail account
        // $('.btn-modal-question-detail').click(function(){
            
        //     $('#modal-question-detail').modal('show');

        //     let id_tb_akun = $(this).attr('id_tb_akun');
        //     let link_answer = "<?=base_url()?>ustadz/jawaban-saya/"+id_tb_akun;
        //     $.get("<?=base_url()?>ustadz/getQuestionEnteredById/"+id_tb_akun, function(data) {
        //         let result = JSON.parse(data);
        //         result.data.forEach(element => {
        //             $('#question-detail').text(element.tb_pertanyaan_isi);
        //             $('#btn-question-detail').attr('href', link_answer);
        //         });
        //     });
            
        // });
        // end click detail account

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
            
            $('#account-data').empty();

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
            // $('.btn-modal-question-detail').click(function(){
                
            //     $('#modal-question-detail').modal('show');

            //     let id_tb_akun = $(this).attr('id_tb_akun');
            //     let link_answer = "<?=base_url()?>ustadz/jawaban-saya/"+id_tb_akun;
            //     $.get("<?=base_url()?>ustadz/getQuestionEnteredById/"+id_tb_akun, function(data) {
            //         let result = JSON.parse(data);
            //         result.data.forEach(element => {
            //             $('#question-detail').text(element.tb_pertanyaan_isi);
            //             $('#btn-question-detail').attr('href', link_answer);
            //         });
            //     });
                
            // });
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
            
            $('#account-data').empty();

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
            // $('.btn-modal-question-detail').click(function(){
                
            //     $('#modal-question-detail').modal('show');

            //     let id_tb_akun = $(this).attr('id_tb_akun');
            //     let link_answer = "<?=base_url()?>ustadz/jawaban-saya/"+id_tb_akun;
            //     $.get("<?=base_url()?>ustadz/getQuestionEnteredById/"+id_tb_akun, function(data) {
            //         let result = JSON.parse(data);
            //         result.data.forEach(element => {
            //             $('#question-detail').text(element.tb_pertanyaan_isi);
            //             $('#btn-question-detail').attr('href', link_answer);
            //         });
            //     });
                
            // });
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
            
            $('#account-data').empty();

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
            // $('.btn-modal-question-detail').click(function(){
                
            //     $('#modal-question-detail').modal('show');

            //     let id_tb_akun = $(this).attr('id_tb_akun');
            //     let link_answer = "<?=base_url()?>ustadz/jawaban-saya/"+id_tb_akun;
            //     $.get("<?=base_url()?>ustadz/getQuestionEnteredById/"+id_tb_akun, function(data) {
            //         let result = JSON.parse(data);
            //         result.data.forEach(element => {
            //             $('#question-detail').text(element.tb_pertanyaan_isi);
            //             $('#btn-question-detail').attr('href', link_answer);
            //         });
            //     });
                
            // });
            // end click detail question

        });
        // end click pagination

    });

    let data = <?=json_encode(@$data['data'])?>;

        // form validation
        function validateForm() {     
            let username = $.trim(document.forms["form-register"]["tb_akun_username"].value);
            let password_one = document.forms["form-register"]["tb_akun_password"].value;
            let password_two = document.forms["form-register"]["tb_akun_password_cek"].value;
            let level = document.forms["form-register"]["tb_akun_level"].value;
            if (password_one != password_two) {
                document.forms["form-register"]["tb_akun_password_cek"].focus();
                $('#same-username').hide();
                $('#level-ket').hide();
                $('#username').removeClass('border-red');
                $('#password-one').removeClass('border-red');
                $('#password-two').addClass('border-red');
                return false;
            }else if(username == '' && password_one == '' && level == ''){
                document.forms["form-register"]["tb_akun_username"].focus();
                $('#same-username').hide();
                $('#level-ket').hide();
                $('#username').addClass('border-red');
                $('#password-one').removeClass('border-red');
                $('#password-two').removeClass('border-red');
                $('#level').removeClass('border-red');
                return false;
            }else if(username != '' && password_one == '' && level == ''){
                document.forms["form-register"]["tb_akun_password"].focus();
                $('#same-username').hide();
                $('#level-ket').hide();
                $('#username').removeClass('border-red');
                $('#password-one').addClass('border-red');
                $('#password-two').removeClass('border-red');
                $('#level').removeClass('border-red');
                return false;
            }else if(username == '' && password_one != '' && level == ''){
                document.forms["form-register"]["tb_akun_username"].focus();
                $('#same-username').hide();
                $('#level-ket').hide();
                $('#username').addClass('border-red');
                $('#password-one').removeClass('border-red');
                $('#password-two').removeClass('border-red');
                $('#level').removeClass('border-red');
                return false;
            }else if(username == '' && password_one == '' && level != ''){
                document.forms["form-register"]["tb_akun_username"].focus();
                $('#same-username').hide();
                $('#level-ket').hide();
                $('#username').addClass('border-red');
                $('#password-one').removeClass('border-red');
                $('#password-two').removeClass('border-red');
                $('#level').removeClass('border-red');
                return false;
            }else if(username != '' && password_one == '' && level != ''){
                document.forms["form-register"]["tb_akun_password"].focus();
                $('#same-username').hide();
                $('#level-ket').hide();
                $('#username').removeClass('border-red');
                $('#password-one').addClass('border-red');
                $('#password-two').removeClass('border-red');
                $('#level').removeClass('border-red');
                return false;
            }else if(username == '' && password_one != '' && level != ''){
                document.forms["form-register"]["tb_akun_username"].focus();
                $('#same-username').hide();
                $('#level-ket').hide();
                $('#username').addClass('border-red');
                $('#password-one').removeClass('border-red');
                $('#password-two').removeClass('border-red');
                $('#level').removeClass('border-red');
                return false;
            }else if(username != '' && password_one != '' && level == ''){
                document.forms["form-register"]["tb_akun_level"].focus();
                $('#same-username').hide();
                $('#level-ket').hide();
                $('#username').removeClass('border-red');
                $('#password-one').removeClass('border-red');
                $('#password-two').removeClass('border-red');
                $('#level').addClass('border-red');
                return false;
            }else{
                let count = 0;
                data.forEach(element =>{
                    if(element.tb_akun_username == username){
                        count = 1;
                    }
                });

                if(count == 1){
                    document.forms["form-register"]["tb_akun_username"].focus();
                    $('#same-username').show().addClass('text-red');
                    $('#username').addClass('border-red');
                    $('#password-one').removeClass('border-red');
                    $('#password-two').removeClass('border-red');
                    return false;
                }

                if(level != 0 && level != 1 && level != 2 && level != 3){
                    document.forms["form-register"]["tb_akun_level"].focus();
                    $('#same-username').hide();
                    $('#username').removeClass('border-red');
                    $('#password-one').removeClass('border-red');
                    $('#password-two').removeClass('border-red');
                    $('#level').addClass('border-red');
                    $('#level-ket').show().addClass('text-red');
                    return false;
                }

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
                let level = '';
                for(let i = page; i <= ((page+dataMod)-1); i++){
                    if(data[i].tb_akun_level == '0'){
                        level = 'Super Admin';
                    }else if(data[i].tb_akun_level == '1'){
                        level = 'Editor';
                    }else if(data[i].tb_akun_level == '2'){
                        level = 'Ustadz';
                    }else if(data[i].tb_akun_level == '3'){
                        level = 'User';
                    }
                    let row =   '<div class="single-post-area mb-30">'+
                                    '<div class="row align-items-center">'+
                                        
                                        '<div class="col-12 col-lg-12 bg-darkself shadow">'+
                                            '<div class="mt-4">'+
                                                // '<a href="<?=base_url()?>super/edit-akun/'+data[i].id_tb_akun+'" class="post-cata cata-sm cata-success ml-2 edit-akun">Edit</a>'+
                                                '<a href="<?=base_url()?>super/delete-akun/'+data[i].id_tb_akun+'" class="post-cata cata-sm cata-danger ml-2 delete-akun">Hapus</a>'+
                                            '</div>'+
                                            '<p>'+_dateIND(data[i].tb_akun_tgl)+'</p>'+
                                            '<h5 class="text-white"> Username : '+data[i].tb_akun_username+'</h5>'+ 
                                            '<h5 class="text-white">Password : *************</h5>'+                                    
                                            '<div class="row">'+
                                                '<div class="container mb-3 pt-0 pb-0">'+
                                                    '<p class="post-cata cata-sm cata-success mb-0 right">'+level+'</p>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+

                                    '</div>'+
                                '</div>';

                    $("#account-data").append(row);
                } 
            }else{
                let level = '';
                for(let i = page; i <= (page+4); i++){

                    if(data[i].tb_akun_level == '0'){
                        level = 'Super Admin';
                    }else if(data[i].tb_akun_level == '1'){
                        level = 'Editor';
                    }else if(data[i].tb_akun_level == '2'){
                        level = 'Ustadz';
                    }else if(data[i].tb_akun_level == '3'){
                        level = 'User';
                    }
                    let row =   '<div class="single-post-area mb-30">'+
                                    '<div class="row align-items-center">'+
                                        
                                        '<div class="col-12 col-lg-12 bg-darkself shadow">'+
                                            '<div class="mt-4">'+
                                                // '<a href="<?=base_url()?>super/edit-akun/'+data[i].id_tb_akun+'" class="post-cata cata-sm cata-success ml-2 edit-akun">Edit</a>'+
                                                '<a href="<?=base_url()?>super/delete-akun/'+data[i].id_tb_akun+'" class="post-cata cata-sm cata-danger ml-2 delete-akun">Hapus</a>'+
                                            '</div>'+
                                            '<p>'+_dateIND(data[i].tb_akun_tgl)+'</p>'+
                                            '<h5 class="text-white"> Username : '+data[i].tb_akun_username+'</h5>'+ 
                                            '<h5 class="text-white">Password : *************</h5>'+                                    
                                            '<div class="row">'+
                                                '<div class="container mb-3 pt-0 pb-0">'+
                                                    '<p class="post-cata cata-sm cata-success mb-0 right">'+level+'</p>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+

                                    '</div>'+
                                '</div>';

                    $("#account-data").append(row);
                }
            }
        }else{
            let row = '<div class="single-post-area mb-30">'+
                            '<div class="row align-items-center">'+
                                '<div class="col-12 col-lg-12">'+
                                    '<h5 class="text-center text-default">Tidak ada akun.</h5>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            $("#account-data").append(row);
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

</script>