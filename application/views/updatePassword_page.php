<style type="text/css">

    #update_password_form{
        width: 400px;
        height: 500px;
        margin: 40px auto;
        padding: 20px;
        color: #67717D;
        background: #F7F8FA;
    }


</style>

</head>
<body>
<h2 style="text-align: center; margin-top: 10px; color:#67717D; ">Update your Password</h2>

<div id="update_password_form">
    <form action="<?php echo base_url();?>ForgetPassword/update_password" method="post">
        <div class="form-group">
            <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i>: </label>
            <?php if (isset($email_hash, $email_code)) {?>
            <input type = "hidden" value="<?php echo $email_hash;?>" name="email_hash"/>
            <input type = "hidden" value="<?php echo $email_code;?>" name="email_code"/>
            <?php }?>
            <input type="text" style="width: 250px;" value="<?php echo (isset($email))? $email : '';?>" name="email"/>
        </div>
        <div class="form-group">
            <label for="password"> <i class="fa fa-lock fa-lg"></i>: </label>
            <input type="password" style="width: 250px;" value="" placeholder="New Password" name="password"/>
        </div>
        <div class="form-group">
            <label for="password"> <i class="fa fa-lock fa-lg"></i>: </label>
            <input type="password" style="width: 250px;" value="" placeholder="Confirm New Password" name="password_conf"/>
        </div>
        <br><br><br>
        <div class="form-group">
            <input class="btn btn-success float-right" type="submit" name="submit" value="Reset Password"/>
        </div>
    </form>

    <?php
        echo validation_errors('<p class="error">');
    ?>


</div>









