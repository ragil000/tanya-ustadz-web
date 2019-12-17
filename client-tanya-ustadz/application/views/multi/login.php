<div class="vizew-login-area section-padding-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                
                <div class="alert" id="alert-login" role="alert">
                    <strong><?=@$result['message']?></strong>
                </div>

                <div class="login-content">
                    <!-- Section Title -->
                    <div class="section-heading">
                        <h4>Silahkan masuk untuk mulai bertanya.</h4>
                        <div class="line"></div>
                    </div>

                    <form action="<?=base_url()?>multi/cekMasuk" method="post">
                        <div class="form-group">
                            <input type="text" name="tb_akun_username" class="form-control text-white" id="exampleInputEmail1" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="tb_akun_password" class="form-control text-white" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <a href="<?=base_url()?>multi/daftar">Belum punya akun?</a>
                            <!-- <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                            </div> -->
                        </div>
                        <button type="submit" class="btn vizew-btn w-100 mt-30">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

    if(@$result['status'] === true){
        redirect('multi/beranda');
    }

?>

<script type="text/javascript">

    alertMessage = '<?=@$result['message']?>';
    $('#alert-login').hide();

    if(alertMessage != ''){
        $('#alert-login').show().addClass('alert-danger');
        setTimeout(function(){$("#alert-login").fadeOut('slow');}, 2500);
    }
   
</script>