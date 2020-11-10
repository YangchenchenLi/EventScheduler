<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css">

    <style type="text/css">

        body{
            background: url(https://cdn.pixabay.com/photo/2019/05/19/23/47/clouds-4215608_1280.jpg) no-repeat;
            background-size:cover;
        }
        table{
            border: 15px solid #25BAE4;
            border-collapse:collapse;
            margin-top: 50px;
            margin-left: 150px;
        }

        td{
            width: 100px;
            height: 100px;
            text-align: center;
            border: 1px solid #e2e0e0;
            font-size: 18px;
            font-weight: bold;
            background-color: rgba(255,255,255,0.2);
        }

        .days td:hover{
            background-color:deeppink;
        }

        th{
            height: 50px;
            padding-bottom: 8px;
            background:#25BAE4;
            font-size: 20px;
        }
        .prev_sign a, .next_sign a{
            color:white;
            text-decoration: none;
        }
        tr.week_name{
            font-size: 16px;
            font-weight:400;
            color:red;
            width: 10px;
            background-color: #efe8e8;
        }
        .highlight{
            background-color:#25BAE4;
            color:white;
            /*height: 98px;*/
            padding-top: 13px;
            /*padding-bottom: 7px;*/
        }

        .remove_btn{
            text-decoration: underline;
        }

        .remove_btn:hover{
            background-color: white;
        }
    </style>

    <script type="text/javascript">
        // create calendar event from users' prompt input.
        $(document).ready(function () {

            $('.click').click(function () {
                // day_num = $(this).find('.day_num').html();
                day_num = $(this).parent().find('.day_num').html();
                day_data = prompt('Add event: ', $(this).parent().find('.content').html());
                // get the current user id from calender
                uid = <?php echo $uid;?>;

                // if the day data is not empty, post data to create new event content.
                if(day_data != null){
                    $.ajax({
                        url:window.location,
                        method:'POST',
                        data:{
                            day: day_num,
                            data: day_data,
                            uid: uid
                        },
                        success:function (msg) {
                            location.reload();
                        }
                    });
                }

            });

            // add remove button if there is event in day cell
            if($('.content').html()){
                remove = "<button class='remove_btn btn'>remove</button>";
                // append input filed
                $('.content').parent().append(remove);
            }

            // click remove to remove event
            $('.remove_btn').click(function () {
                // get the current user id from calender
                uid = <?php echo $uid;?>;
                day_num = $(this).parent().find('.day_num').html();
                remove_event = confirm("Delete this event?");
                if(remove_event == true){
                    $.ajax({
                        url: window.location,
                        method: 'POST',
                        data:{
                            remove: true,
                            day: day_num,
                            uid: uid
                        },
                        success:function () {
                            location.reload();
                        }
                    });
                    alert("deleted");
                }
            });
        });
    </script>
</head>

    <body>

    <div class="collapse navbar-collapse">
        <h1>Calendar</h1>
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
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>home">Home &nbsp;&nbsp;<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo base_url ();?>Calendar">
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






        <div class="container">
            <p style="color: white; text-align: center;">(Please click specific day to add events)</p>
            <div id-="calendar">
                <?php
                // Generate calendar
                echo $calender;
                ?>
            </div>
            

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script type="text/javascript" href="<?php echo base_url(); ?>resources/js/jquery.js"></script>
        <script
                src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous">
        </script>
    </body>
</html>