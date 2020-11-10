        <title>Home page</title>
        <style type="text/css">
            *{
                margin:0;
                padding:0;
            }
            body{
                background: url(https://cdn.pixabay.com/photo/2019/05/19/23/47/clouds-4215608_1280.jpg) no-repeat;
                background-size:cover;
            }
            #main{
                background: rgba(255,255,255,0.2);
                width: 960px;
                height: 1000px;
                margin: 0 auto;
            }


        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {

                function timeChecker(){
                    setInterval(function () {
                        var storedTimeStamp = sessionStorage.getItem('lastTimeStamp');
                        timeCompare(storedTimeStamp);
                    }, 3000);
                }

                function timeCompare(time){
                    var currentTime = new Date();
                    var pastTime = new Date(time);
                    var timeDiff = currentTime - pastTime;
                    var minPast = Math.floor((timeDiff/60000));

                    console.log(minPast);
                    // did not move mouse for 1 minute
                    if (minPast > 1000){
                        sessionStorage.removeItem('lastTimeStamp');
                        window.location = '<?php echo base_url();?>Login/logout';
                        return false;

                    }else {
                        console.log(minPast+ "min past");
                    }
                }

                $(document).mousemove(function () {
                    var timeStamp = new Date();
                    sessionStorage.setItem('lastTimeStamp', timeStamp);
                });

                timeChecker();









            });


        </script>
        </head>

        <body>
        <!--log in successful message -->
        <?php if ($this->session->flashdata()) { ?>
            <div class="alert alert-warning">
                <?= $this->session->flashdata('msg_login'); ?>
            </div>
        <?php } ?>

        <div class="collapse navbar-collapse">
            <h1>Home</h1>
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
                <ul class="navbar-nav mr-auto nav-tabs ">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url(); ?>home">Home &nbsp;&nbsp;<span class="sr-only">(current)</span></a>
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
                            <a class="nav-link" href="<?php echo base_url();?>Products">Membership</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <!--search event-->
                <div class="nav-item">
                    <a class="nav-link float-right" href="<?php echo base_url();?>Ajaxsearch" role="button"> <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Event</a>
                </div>
            </div>
        </nav>

            <!--Main content-->
            <div id="main">
                <!-- add event button-->
                <div>
                    <a class="btn btn-primary btn-lg btn-block" href="<?php echo base_url();?>Calendar" role="button">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        New Event
                    </a>
                </div>

                <br><br><br>









            </div>





