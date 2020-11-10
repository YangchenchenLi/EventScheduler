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

        <title>Sign up page</title>

        <style type="text/css">
            *{
                margin: 0;
                padding: 0;
            }

            .page-header{
                text-align: center;
                height: 100px;
                width: 33.33%;
                margin: 0 auto;
            }
            body{
                background: url(https://cdn.pixabay.com/photo/2019/05/19/23/47/clouds-4215608_1280.jpg) no-repeat;
            }
            .form{
                background: rgba(255,255,255,0.2);
                width:400px;
                height: 500px;
                margin:100px auto;
            }
            form label.error {
                color: Red;
            }
        </style>

        <script type="text/javascript">
            $().ready(function(){
                $("#signin_form").validate({
                    rules:{
                        email:{
                            email:true,
                        },
                        password:{
                            minlength:6,
                        },
                        confirm_password:{
                            equalTo:"#password",
                        }
                    },
                    messages:{
                        username:"Please enter your username.",
                        email:{
                            required:"Please enter your email.",
                            email:"Please enter invalide email.",
                        },
                        password:{
                            required:"Please enter your password.",
                            minlength:"Password should have no less than 6.",
                        },
                        confirm_password:{
                            equalTo:"Please enter the same password.",
                        },
                    }
                });


                // check the condition of check box
                $('input[type="checkbox"]').click(function(){
                    if($(this).prop("checked") === true){
                        $('#submit').removeClass('disabled');
                    }else{
                        $('#submit').addClass('disabled');
                    }
                });
            });
        </script>
    </head>

    <body>
    <?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-warning">
            <?= $this->session->flashdata('msg'); ?>
            <?= $this->session->flashdata('verify_msg'); ?>
        </div>
    <?php } ?>
        <header>
        </header>

        <div class="container">
            <div class="form row">    
                <!--Create a form-->
                <form class="form-horizontal col-sm-offset-3 col-md-offset-3" role="form" id="signin_form" action="<?php echo base_url();?>Register/doRegister" method="POST">                    
                    <h2 class="form-title">Sign in</h2>
                    <div class="col-sm-9 col-md-9">
                        <!-- create user name -->
                        <div class="form-group">
                            <input class="form-control required" style="font-family: Arial, 'Font Awesome 5 Free'" type="text" placeholder="&#xf007; Username" name="username" autofocus="autofocus" maxlength="20"/> 
                        </div>
                        <!-- enter email address -->
                        <div class="form-group">
                            <input class="form-control required" style="font-family: Arial, 'Font Awesome 5 Free'" type="text" placeholder="&#xf0e0; Email" name="email"/> 
                        </div>
                        <!-- create password -->
                        <div class="form-group">
                            <input class="form-control required" id="password" style="font-family: Arial, 'Font Awesome 5 Free'" type="password" placeholder="&#xf070; Password" name="password" maxlength="8"/> 
                        </div>
                        <!-- confrim password -->
                        <div class="form-group">
                            <input class="form-control required" style="font-family: Arial, 'Font Awesome 5 Free'" type="password" placeholder="&#xf070; Confirm password" name="confirm_password" maxlength="8"/> 
                        </div>
                        <!-- checkbox -->
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" name="accept" value="1"> I accept the Terms of Service and Privacy Policy.
                            </label>
                        </div>
                        <!-- submit button -->
                        <div class="form-group">
                            <input id="submit" type="submit" class="btn disabled btn-success pull-right" value="Sign in "/>
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