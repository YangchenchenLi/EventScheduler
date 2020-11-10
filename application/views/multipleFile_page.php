
<title>Multiple File Upload</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style>

    h3{
        text-align: center;
    }


    .upload{
        width: 960px;
        margin: 50px auto;
        background-color: rgba(255,255,255,0.2);
    }

    .row h3{
        display: block;
        text-align: center;
    }


</style>

</head>

<body>


<div class="collapse navbar-collapse">
    <h1>Gallery</h1>
    <ul class="nav nav-tabs list-unstyled float-right">
        <!-- if user logged in, show logout button-->
        <?php if($this->session->userdata('logged_in')) : ?>
            <li class="nav-item">
                <a href="<?php echo base_url();?>Profile" style="color:black;">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <?php
                    echo $this->session->userdata('username');
                    ?>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Login/logout"  style="color:black;">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                    Logout </a>
            </li>
        <?php endif; ?>

        <!-- if user didn't log in, show login button-->
        <?php if(!$this->session->userdata('logged_in') && (!$this->session->userdata('user_data'))) : ?>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>Login" style="color:black;">
                    <i class="fa fa-user fa-lg"></i>
                    Login
                </a>
            </li>
            &nbsp;
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>Register" style="color:black;">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                    Sign Up
                </a>
            </li>
        <?php endif; ?>

        <!--log in via Oauth with Google-->
        <?php if ($this->session->userdata('user_data')):?>
            <?php $user_data = $this->session->userdata('user_data');?>
            <li class="nav-item">
                <a href="<?php echo base_url();?>Profile" style="color:black;">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <?php
                    echo $user_data['username'];
                    ?>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Login/logout"  style="color:black;">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                    Logout </a>
            </li>
        <?php endif; ?>
    </ul>
</div>

<!--Nav bar-->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="#">Navbar</a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>home">Home &nbsp;&nbsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url ();?>Calendar">
                    Calendar &nbsp;&nbsp;
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>Scroll_pagination">&nbsp;&nbsp;Explore Event&nbsp;&nbsp;</a>
            </li>

            <!--if user logged in, show user profile link-->
            <?php if($this->session->userdata('logged_in')) : ?>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo base_url();?>MultipleFile">Gallery &nbsp;</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>Profile">User Profile &nbsp;&nbsp; </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>Products">Membership<span class="sr-only">(current)</span></a>
                </li>
            <?php endif; ?>
        </ul>
        <!--search event-->
        <div class="nav-item">
            <a class="nav-link float-right" href="<?php echo base_url();?>Ajaxsearch" role="button"> <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Event</a>
        </div>
    </div>
</nav>







    <h3 style="margin: 50px auto;">Gallery</h3>
    <div class="container">
    <?php if($this->session->userdata('logged_in')) : ?>
        <!-- Display status message -->
        <?php echo !empty($statusMsg)?'<p class="status-msg">'.$statusMsg.'</p>':''; ?>
        <div class="upload">
            <!-- File upload form -->
            <form method="post" action="<?php echo base_url();?>MultipleFile" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Choose Files</label>
                    <input type="file" class="form-control" name="files[]"  multiple/>
                </div>
                <div class="form-group">
                    <input class="form-control btn-primary" type="submit" name="fileSubmit" value="UPLOAD"/>
                </div>
            </form>
        </div>
    </div>
    <!-- Display uploaded images -->
    <div class="row card">
        <h3>Uploaded Files/Images</h3>
        <br><br>
        <div class="row  text-center text-lg-left">
            <?php if(!empty($files)){ foreach($files as $file){ ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <img class="img-fluid img-thumbnail" src="uploads/gallery/<?php echo $file['file_name'];?>">
                    <p>Uploaded On <?php echo date("j M Y",strtotime($file['uploaded_on'])); ?></p>
                </div>
            <?php } }else{ ?>
                <p>&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your gallery is empty...</p>
            <?php } ?>
        </div>
    </div>

    <?php endif; ?>

