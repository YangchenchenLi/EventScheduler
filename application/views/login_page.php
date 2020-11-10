<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css">
    <!-- jquery validate -->
    <script type="text/javascript" href="<?php echo base_url(); ?>resources/js/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

        <title>Lognin</title>
        <style type="text/css">  
            body{
                background: url(https://cdn.pixabay.com/photo/2019/05/19/23/47/clouds-4215608_1280.jpg) no-repeat;
                background-size:cover;
                font-size: 16px;
            }  
            .form{
                background: rgba(255,255,255,0.2);
                width:400px;
                height: 700px;
                margin:100px auto;
            } 
            #login_form{
                display: block;
            }  
            #register_form{
                display: none;
            }  
            .fa{
                display: inline-block;
                top: 27px;
                left: 6px;
                position: relative;
                color: #ccc;
            }  
            .checkbox{
                padding-left:21px;
            }  

            form label.error {
                color: Red;
            }
        </style> 

        <script type="text/javascript">
            $().ready(function(){
                $("#login_form").validate({
                    rules:{
                        password:{
                            minlength:6,
                        },
                    },
                    messages:{
                        username:"Please enter your username",
                        password:{
                            required:"Please enter your password",
                        },
                    }
                });

                $('.refreshCaptcha').on('click', function(){
                    $.get('<?php echo base_url().'Login/captchaRefresh'; ?>', function(data){
                        $('#captImg').html(data);
                    });
                });
            });


        </script>
    </head>

    <body>
        <?php if ($this->session->flashdata()) { ?>
            <div class="alert alert-warning">
                <?= $this->session->flashdata('msg'); ?>
                <!--the email verify message-->
                <?= $this->session->flashdata('verify_msg'); ?>
                <!--password updating message-->
                <?= $this->session->flashdata('update_msg'); ?>
            </div>
        <?php } ?>

        <div class="container">  
            <div class="form row"> 
                 <!--create login form  -->
                <form class="form-horizontal col-sm-offset-3 col-md-offset-3" id="login_form"
                action="<?php echo base_url();?>Login/doLogin" method='post'> 
                     <!--form titile  -->
                    <h3 class="form-title">Login</h3>  
                    <div class="col-sm-12 col-md-12">
                        <!-- enter username -->
                        <div class="form-group">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <input class="form-control required" type="text" style="padding-left: 30px;" placeholder="Username" name="username" autofocus="autofocus" maxlength="50"
                            value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"
                            />
                        </div>
                        <!--enter user email  -->
                        <div class="form-group">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <input class="form-control required" type="text" style="padding-left: 30px;" placeholder="Email" name="email" autofocus="autofocus" maxlength="100"
                               value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>"
                            />
                        </div>  
                        <!-- enter password -->
                        <div class="form-group">  
                                <i class="fa fa-lock fa-lg"></i>  
                                <input class="form-control required" type="password" style="padding-left: 30px;" placeholder="Password" name="password" maxlength="20"
                                       value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>"
                                />
                        </div>
                        <!--captcha -->
                        <div class="form-group">
                            <p id="captImg"><?php echo $captchaImg; ?></p>
                            <p>click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>
                                <input class="form-control" type="text" name="captcha" placeholder="Captcha: case sensitive" value="" maxlength="100"/>
                        </div>


                        <!-- check box -->
                        <div class="form-group">  
                            <label class="form-check-label">
                                <input type="checkbox" name="remember" value="Remember me" <?php if (get_cookie('email') && get_cookie('username')) { ?> checked="checked" <?php } ?>/> Remember me
                            </label>
                            <hr />
                            <a href="<?php echo base_url ();?>Register/index" id="register_btn" class="">Create new account</a>
                        </div>


                        <!-- login button -->
                        <div class="form-group">  
                            <input type="submit" class="btn btn-success pull-right" value="Login "/>
                            <br><br>
                        </div>
                        <div class="form-group">
                            <a href="<?php echo base_url ();?>ForgetPassword" id="register_btn" class="">Forget Password?</a>
                            <br> <br>
                            <a href="<?php echo base_url ();?>Home/login" class="">Login with Google</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script type="text/javascript" href="<?php echo base_url(); ?>resources/js/jquery.js"></script>
        <script type="text/javascript" href="<?php echo base_url(); ?>resources/js/bootstrap.min.js"></script>

        <!-- validate jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
    </body>
</html>




        
