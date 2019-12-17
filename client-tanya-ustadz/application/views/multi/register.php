<div class="vizew-login-area section-padding-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">

                <div class="login-content">
                    <!-- Section Title -->
                    <div class="section-heading">
                        <h4>Silahkan isi form pendaftaran dibawah untuk bisa mulai bertanya.</h4>
                        <div class="line"></div>
                    </div>

                    <form action="<?=base_url()?>multi/postRegister" name="form-register" method="post" onsubmit="return validateForm()">
                        <div class="form-group">
                            <p id="same-username" class="pt-0 pb-0 mt-0 mb-0">Nama user sudah ada.</p>
                            <input type="text" id="username" name="tb_akun_username" class="form-control text-white" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" id="password-one" name="tb_akun_password" class="form-control text-white" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" id="password-two" name="tb_akun_password_cek" class="form-control text-white" placeholder="Tulis Ulang Password">
                            <input type="text" name="tb_akun_level" value="3" hidden>
                        </div>
                        <div class="form-group">
                            <a href="<?=base_url()?>multi/masuk">Sudah punya akun?</a>
                            <!-- <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                            </div> -->
                        </div>
                        <button type="submit" class="btn vizew-btn w-100 mt-30">Mendaftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    let data = <?=json_encode(@$result['data'])?>;
    $('#same-username').hide();

    // form validation
    function validateForm() {     
        let username = $.trim(document.forms["form-register"]["tb_akun_username"].value);
        let password_one = document.forms["form-register"]["tb_akun_password"].value;
        let password_two = document.forms["form-register"]["tb_akun_password_cek"].value;
        if (password_one != password_two) {
            document.forms["form-register"]["tb_akun_password_cek"].focus();
            $('#same-username').hide();
            $('#username').removeClass('border-red');
            $('#password-one').removeClass('border-red');
            $('#password-two').addClass('border-red');
            return false;
        }else if(username == '' && password_one == ''){
            document.forms["form-register"]["tb_akun_username"].focus();
            $('#same-username').hide();
            $('#username').addClass('border-red');
            $('#password-one').removeClass('border-red');
            $('#password-two').removeClass('border-red');
            return false;
        }else if(username != '' && password_one == ''){
            document.forms["form-register"]["tb_akun_password"].focus();
            $('#same-username').hide();
            $('#username').removeClass('border-red');
            $('#password-one').addClass('border-red');
            $('#password-two').removeClass('border-red');
            return false;
        }else if(username == '' && password_one != ''){
            document.forms["form-register"]["tb_akun_username"].focus();
            $('#same-username').hide();
            $('#username').addClass('border-red');
            $('#password-one').removeClass('border-red');
            $('#password-two').removeClass('border-red');
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

        }
    }
   
</script>