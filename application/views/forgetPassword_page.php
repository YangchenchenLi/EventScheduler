
<style type="text/css">

    #content{
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
<?php if ($this->session->flashdata()) { ?>
    <div class="alert alert-warning">
        <?= $this->session->flashdata('msg'); ?>
    </div>
<?php } ?>

<div id="main">
    <div id="content">
        <?php if(isset($error)) echo $error; ?>
        <h2 style="text-align: center;">Forgot Password</h2>
        <br>
        <form method="post" action='<?php echo base_url();?>ForgetPassword/checkEmail'>
            <p>Please enter your account email address</p>
            <br>
            <label> <i class="fa fa-envelope" aria-hidden="true"></i>:</label>
            &nbsp;
            <input type="text" name="email" id="name" placeholder="Email Address"/><br /><br /><br /><br /><br /><br /><br /><br />
            <input class="btn btn-success float-right" type="submit" value="Reset Password" name="forgot_password"/><br />
        </form>
    </div>
</div>