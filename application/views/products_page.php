<title>Membership</title>
<style type="text/css">
    body{
        background: url(https://cdn.pixabay.com/photo/2019/05/19/23/47/clouds-4215608_1280.jpg) no-repeat;
        background-size:cover;
    }

    .pro-box{
        display: block;
        background-color: rgba(255,255,255,0.2);
        margin: 20px auto;
        padding: 10px;
        width: 400px;
        height: 200px;
    }

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</head>

<body>
<div class="collapse navbar-collapse">
    <h1>Membership</h1>
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
                    <a class="nav-link" href="<?php echo base_url();?>MultipleFile">Gallery &nbsp;</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>Profile">User Profile &nbsp;&nbsp; </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo base_url();?>Products">Membership<span class="sr-only">(current)</span></a>
                </li>
            <?php endif; ?>
        </ul>
        <!--search event-->
        <div class="nav-item">
            <a class="nav-link float-right" href="<?php echo base_url();?>Ajaxsearch" role="button"> <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Event</a>
        </div>
    </div>
</nav>






<!-- List all products -->
<?php if(!empty($products)){foreach($products as $row){?>
<div class="pro-box">
    <div class="info">
        <h4><?php echo $row['name']; ?></h4>
        <br>
        <h5>Price: <?php echo '$'.$row['price'].' '.$row['currency']; ?></h5>
    </div>
    <br><br>
    <div class="action">
        <a class="btn btn-primary float-right"  href="<?php echo base_url('products/purchase/'.$row['id']); ?>">Purchase</a>
    </div>
</div>

<?php } }else{ ?>

    <p>Product(s) not found...</p>
<?php } ?>