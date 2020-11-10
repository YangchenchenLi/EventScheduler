
<!DOCTYPE html>
<html>
    <head>
        <title>Popular Events</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <style>
        @-webkit-keyframes placeHolderShimmer {
          0% {
            background-position: -468px 0;
          }
          100% {
            background-position: 468px 0;
          }
        }

        @keyframes placeHolderShimmer {
          0% {
            background-position: -468px 0;
          }
          100% {
            background-position: 468px 0;
          }
        }

        .content-placeholder {
          display: inline-block;
          -webkit-animation-duration: 1s;
          animation-duration: 1s;
          -webkit-animation-fill-mode: forwards;
          animation-fill-mode: forwards;
          -webkit-animation-iteration-count: infinite;
          animation-iteration-count: infinite;
          -webkit-animation-name: placeHolderShimmer;
          animation-name: placeHolderShimmer;
          -webkit-animation-timing-function: linear;
          animation-timing-function: linear;
          background: #f6f7f8;
          background: -webkit-gradient(linear, left top, right top, color-stop(8%, #eeeeee), color-stop(18%, #dddddd), color-stop(33%, #eeeeee));
          background: -webkit-linear-gradient(left, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
          background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
          -webkit-background-size: 800px 104px;
          background-size: 800px 104px;
          height: inherit;
          position: relative;
        }

        .post_data
        {
          padding:24px;
          border:1px solid #f9f9f9;
          border-radius: 5px;
          margin-bottom: 24px;
          box-shadow: 10px 10px 5px #eeeeee;
        }
        </style>
    </head>
    <body>

    <div class="collapse navbar-collapse">
        <h1>Explore Event</h1>
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
                    <a class="nav-link active" href="<?php echo base_url();?>Scroll_pagination">&nbsp;&nbsp;Explore Event&nbsp;&nbsp;</a>
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



    <form name="postPosition" id="postPosition" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input name="chart_x" id="chart_x" type="hidden" value="" />
        <input name="chart_y" id="chart_y" type="hidden" value="" />
    </form>


    <div class="container">
            <h2 align="center"><u>Popular Events</u></h2>
            <br />
            <div id="load_data"></div>
            <div id="load_data_message"></div>

            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
        </div>
    </body>
</html>
<script>
  $(document).ready(function(){


    var limit = 7;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit)
    {
      var output = '';
      for(var count=0; count<limit; count++)
      {
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
      }
      $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start){
      $.ajax({
        url:"<?php echo base_url(); ?>scroll_pagination/fetch",
        method:"POST",
        data:{limit:limit, start:start},
        cache: false,
        success:function(data){
          if(data == ''){
            $('#load_data_message').html('<h3>No More Result Found</h3>');
            action = 'active';
          }
          else{
            $('#load_data').append(data);
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive'){
      action = 'active';
      load_data(limit, start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start);
        }, 1000);
      }
    });


    // maintain scroll position when user return
      // If cookie is set, scroll to the position saved in the cookie.
      if ( $.cookie("scroll") !== null ) {
          $(document).scrollTop( $.cookie("scroll") );
      }

      // When scrolling happens....
      $(window).on("scroll", function() {

          // Set a cookie that holds the scroll position.
          $.cookie("scroll", $(document).scrollTop() );

      });


  });
</script>